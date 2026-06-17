<?php

namespace App\Http\Controllers\Web\Customer;

use App\Contracts\Repositories\BusinessSettingRepositoryInterface;
use App\Contracts\Repositories\RobotsMetaContentRepositoryInterface;
use App\Http\Requests\Web\CustomerProfileUpdateRequest;
use App\Models\SupportTicketConv;
use App\Traits\PdfGenerator;
use App\Utils\Helpers;
use App\Events\OrderStatusEvent;
use App\Helpers\Helpers as HelpersHelpers;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\DeliveryMan;
use App\Models\DeliveryZipCode;
use App\Models\Estate;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductCompare;
use App\Models\RefundRequest;
use App\Models\Review;
use App\Models\Seller;
use App\Models\ShippingAddress;
use App\Models\SupportTicket;
use App\Models\Wishlist;
use App\Traits\CommonTrait;
use App\Models\User;
use App\Utils\CustomerManager;
use App\Utils\ImageManager;
use App\Utils\OrderManager;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Agent;

class UserProfileController extends Controller
{
    // use CommonTrait, PdfGenerator;

    public function __construct(
        private Order                                         $order,
        private User                                        $seller,
        private Estate                                       $product,
        private Review                                        $review,

        private Wishlist                                      $wishlist,
        // private readonly BusinessSettingRepositoryInterface   $businessSettingRepo,
        // private readonly RobotsMetaContentRepositoryInterface $robotsMetaContentRepo,
    )
    {

    }

    public function user_profile(Request $request)
    {
        $wishlists = $this->wishlist->whereHas('wishlistProduct', function ($q) {
            return $q;
        })->where('customer_id', auth('customer')->id())->count();
        $total_order = $this->order->where('customer_id', auth('customer')->id())->count();
        $total_loyalty_point = auth('customer')->user()->loyalty_point;
        $total_wallet_balance = auth('customer')->user()->wallet_balance;
        // $addresses = ShippingAddress::where('customer_id', auth('customer')->id())->latest()->get();
        $customer_detail = User::where('id', auth('customer')->id())->first();

        return view(VIEW_FILE_NAMES['user_profile'], compact('customer_detail',  'wishlists', 'total_order', 'total_loyalty_point', 'total_wallet_balance'));
    }

    public function user_account(Request $request)
    {
        // $country_restrict_status = Helpers::get_business_settings('delivery_country_restriction');
        $customerDetail = User::where('id', auth('customer')->id())->first();
        return view(VIEW_FILE_NAMES['user_account'], compact('customerDetail'));

    }

    public function getUserProfileUpdate(CustomerProfileUpdateRequest $request): RedirectResponse
    {



        $user = User::find(auth('customer')->id());



        $user->name = $request->name;


        $user->email = $request->email;
        $user->youtube = $request->youtube;
        $user->snapchat = $request->snapchat;
        $user->instagram = $request->instagram;
        $user->website = $request->website;
        $user->tiktok = $request->tiktok;
        $user->twitter = $request->twitter;






        if ($request->image) {
            $user->image = HelpersHelpers::update(dir:'profile/',old_image: $user->image, format: 'png', image: $request->file('image'));
        }
        $user?->save();
        Toastr::info(translate('updated_successfully'));
        return redirect()->back();
    }


    public function account_address_add()
    {
        $country_restrict_status = Helpers::get_business_settings('delivery_country_restriction');
        $zip_restrict_status = Helpers::get_business_settings('delivery_zip_code_area_restriction');
        $default_location = Helpers::get_business_settings('default_location');

        $countries = $country_restrict_status ? $this->get_delivery_country_array() : COUNTRIES;

        $zip_codes = $zip_restrict_status ? DeliveryZipCode::all() : 0;

        return view(VIEW_FILE_NAMES['account_address_add'], compact('countries', 'zip_restrict_status', 'zip_codes', 'default_location'));
    }

    public function account_delete($id)
    {
        if (auth('customer')->id() == $id) {
            $user = User::find($id);

            $ongoing = ['out_for_delivery', 'processing', 'confirmed', 'pending'];
            $order = Order::where('customer_id', $user->id)->whereIn('order_status', $ongoing)->count();
            if ($order > 0) {
                Toastr::warning(translate('you_can_not_delete_account_due_ongoing_order'));
                return redirect()->back();
            }
            auth()->guard('customer')->logout();

            ImageManager::delete('/profile/' . $user['image']);
            session()->forget('wish_list');

            $user->delete();
            Toastr::info(translate('Your_account_deleted_successfully!!'));
            return redirect()->route('home');
        }

        Toastr::warning(translate('access_denied') . '!!');
        return back();
    }



    public function address_store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|max:20',
            'city' => 'required',
            'zip' => 'required',
            'country' => 'required',
            'address' => 'required',
        ]);

        $numericPhoneValue = preg_replace('/[^0-9]/', '', $request['phone']);
        $numericLength = strlen($numericPhoneValue);
        if ($numericLength < 4 || $numericLength > 20) {
            $request->validate([
                'phone' => 'min:5|max:20',
            ], [
                'phone.min' => translate('The_phone_number_must_be_at_least_4_characters'),
                'phone.max' => translate('The_phone_number_may_not_be_greater_than_20_characters'),
            ]);
        }

        $country_restrict_status = Helpers::get_business_settings('delivery_country_restriction');
        $zip_restrict_status = Helpers::get_business_settings('delivery_zip_code_area_restriction');

        $country_exist = self::delivery_country_exist_check($request->country);
        $zipcode_exist = self::delivery_zipcode_exist_check($request->zip);

        if ($country_restrict_status && !$country_exist) {
            Toastr::error(translate('Delivery_unavailable_in_this_country!'));
            return back();
        }

        if ($zip_restrict_status && !$zipcode_exist) {
            Toastr::error(translate('Delivery_unavailable_in_this_zip_code_area!'));
            return back();
        }

        $address = [
            'customer_id' => auth('customer')->check() ? auth('customer')->id() : null,
            'contact_person_name' => $request['name'],
            'address_type' => $request['addressAs'],
            'address' => $request['address'],
            'city' => $request['city'],
            'zip' => $request['zip'],
            'country' => $request['country'],
            'phone' => $request['phone'],
            'is_billing' => $request['is_billing'],
            'latitude' => $request['latitude'],
            'longitude' => $request['longitude'],
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('shipping_addresses')->insert($address);

        Toastr::success(translate('address_added_successfully!'));

        if (theme_root_path() == 'default') {
            return back();
        } else {
            return redirect()->route('user-profile');
        }
    }

    public function address_edit(Request $request, $id)
    {
        $shippingAddress = ShippingAddress::where('customer_id', auth('customer')->id())->find($id);
        $country_restrict_status = getWebConfig(name: 'delivery_country_restriction');
        $zip_restrict_status = getWebConfig(name: 'delivery_zip_code_area_restriction');

        $delivery_countries = $country_restrict_status ? self::get_delivery_country_array() : COUNTRIES;
        $delivery_zipcodes = $zip_restrict_status ? DeliveryZipCode::all() : 0;

        $countriesName = [];
        $countriesCode = [];
        foreach ($delivery_countries as $country) {
            $countriesName[] = $country['name'];
            $countriesCode[] = $country['code'];
        }

        if (isset($shippingAddress)) {
            return view(VIEW_FILE_NAMES['account_address_edit'], compact('shippingAddress', 'country_restrict_status', 'zip_restrict_status', 'delivery_countries', 'delivery_zipcodes', 'countriesName', 'countriesCode'));
        } else {
            Toastr::warning(translate('access_denied'));
            return back();
        }
    }

    public function address_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|max:20',
            'city' => 'required',
            'zip' => 'required',
            'country' => 'required',
            'address' => 'required',
        ]);

        $numericPhoneValue = preg_replace('/[^0-9]/', '', $request['phone']);
        $numericLength = strlen($numericPhoneValue);
        if ($numericLength < 4 || $numericLength > 20) {
            $request->validate([
                'phone' => 'min:5|max:20',
            ], [
                'phone.min' => translate('The_phone_number_must_be_at_least_4_characters'),
                'phone.max' => translate('The_phone_number_may_not_be_greater_than_20_characters'),
            ]);
        }

        $country_restrict_status = Helpers::get_business_settings('delivery_country_restriction');
        $zip_restrict_status = Helpers::get_business_settings('delivery_zip_code_area_restriction');

        $country_exist = self::delivery_country_exist_check($request->country);
        $zipcode_exist = self::delivery_zipcode_exist_check($request->zip);

        if ($country_restrict_status && !$country_exist) {
            Toastr::error(translate('Delivery_unavailable_in_this_country!'));
            return back();
        }

        if ($zip_restrict_status && !$zipcode_exist) {
            Toastr::error(translate('Delivery_unavailable_in_this_zip_code_area!'));
            return back();
        }

        $updateAddress = [
            'contact_person_name' => $request->name,
            'address_type' => $request->addressAs,
            'address' => $request->address,
            'city' => $request->city,
            'zip' => $request->zip,
            'country' => $request->country,
            'phone' => $request->phone,
            'is_billing' => $request->is_billing,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        if (auth('customer')->check()) {
            ShippingAddress::where('id', $request->id)->update($updateAddress);
            Toastr::success(translate('address_updated_successfully!'));
        } else {
            Toastr::error(translate('Insufficient_permission!'));
        }
        return theme_root_path() == 'default' ? redirect()->route('account-address') : redirect()->route('user-profile');
    }

    public function address_delete(Request $request)
    {
        if (auth('customer')->check()) {
            ShippingAddress::destroy($request->id);
            Toastr::success(translate('address_Delete_Successfully'));
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function account_payment()
    {
        if (auth('customer')->check()) {
            return view('web-views.users-profile.account-payment');

        } else {
            return redirect()->route('home');
        }

    }

    public function account_estate(Request $request)
    {
        $order_by = $request->order_by ?? 'desc';


        $orders= Estate::where("user_id",auth('customer')->id()) ->paginate(4);





        return view(VIEW_FILE_NAMES['account_orders'], compact('orders', 'order_by'));
    }



    public function delete_estate($id)
    {
        // Find the property by its ID
        $property = Estate::find($id);



        if (!$property) {
            // Property not found
            return redirect()->back()->with('error', 'Property not found.');
        }

        // Assuming the images are stored as a JSON array in the 'images' field
        $images = json_decode($property->images, true);

        if (!empty($images)) {
            foreach ($images as $image) {
                // Check if the image exists and delete it
                if (Storage::disk('public')->exists('estate/' . $image)) {
                    Storage::disk('public')->delete('estate/' . $image);
                }
            }
        }

        // Delete the property from the database
        $property->delete();
        return redirect()->back();




    }


 public function uploadImages(Request $request, $id)
{
    if ($request->hasFile('estate_image')) {
        $imageUrls = [];

        foreach ($request->file('estate_image') as $imageFile) {
            $imageName = time() . '_' . $imageFile->getClientOriginalName();
            $imageFile->storeAs('public/estate', $imageName);
            $imageUrls[] = $imageName;
        }

        // Fetch the existing images for the specific record
        $post = Estate::find($id);
        $existingImages = $post->images ?? [];

        // ✨ تحويلها إلى مصفوفة إذا كانت String
        if (is_string($existingImages)) {
            $existingImages = json_decode($existingImages, true) ?? [];
        }

        // Merge old images with new ones
        $allImages = array_merge($existingImages, $imageUrls);

        // Update the column
        $post->update(['images' => $allImages]);

        return response()->json(['message' => 'Images uploaded and updated successfully'], 200);
    } else {
        return response()->json(['message' => 'No images to upload from controller'], 400);
    }
}




public function uploadPlanned(Request $request, $id)
{
    if ($request->hasFile('planned_image')) {
        $imageUrls = [];

        foreach ($request->file('planned_image') as $imageFile) {
            $imageName = time() . '_' . $imageFile->getClientOriginalName();
            $imageFile->storeAs('public/estate', $imageName);
            $imageUrls[] = $imageName;
        }

        // Fetch the existing images for the specific record
        $post = Estate::find($id);
        $existingImages = $post->planned ?? [];

        // ✨ تحويلها إلى مصفوفة إذا كانت String
        if (is_string($existingImages)) {
            $existingImages = json_decode($existingImages, true) ?? [];
        }

        // Merge old images with new ones
        $allImages = array_merge($existingImages, $imageUrls);

        // Update the column
        $post->update(['planned' => $allImages]);

        return response()->json(['message' => 'Images uploaded and updated successfully'], 200);
    } else {
        return response()->json(['message' => 'No images to upload from controller'], 400);
    }
}





    // app/Http/Controllers/PropertyController.php

    public function getImages($id)
    {
        $property = Estate::find($id);

        if (!$property) {
            return response()->json(['success' => false, 'message' => 'Property not found.'], 404);
        }

        $images = json_decode($property->images, true);

        return response()->json(['success' => true, 'images' => $images]);
    }



    public function getPlanned($id)
    {
        $property = Estate::find($id);

        if (!$property) {
            return response()->json(['success' => false, 'message' => 'Property not found.'], 404);
        }

        $images = json_decode($property->planned, true);

        return response()->json(['success' => true, 'images' => $images]);
    }






public function deleteImage($id, $imageUrl)
{
    $images = Estate::find($id);
    if (!$images) {
        return response()->json(['error' => 'No images found'], 404);
    }

    $imagePaths = json_decode($images->images);
    $index = false;

    foreach ($imagePaths as $key => $path) {
        if (basename($path) === $imageUrl) {
            $index = $key;
            break;
        }
    }

    if ($index !== false) {
        // حذف الملف من التخزين
        Storage::delete('public/estate/' . $imageUrl);

        array_splice($imagePaths, $index, 1);
        $images->update(['images' => json_encode($imagePaths)]);

        return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
    }

    return response()->json(['success' => false, 'message' => 'Image not found.'], 404);
}



public function deletePlanned($id, $imageUrl)
{
    $images = Estate::find($id);
    if (!$images) {
        return response()->json(['error' => 'No images found'], 404);
    }

    $imagePaths = json_decode($images->planned);
    $index = false;

    foreach ($imagePaths as $key => $path) {
        if (basename($path) === $imageUrl) {
            $index = $key;
            break;
        }
    }

    if ($index !== false) {
        // حذف الملف من التخزين
        Storage::delete('public/estate/' . $imageUrl);

        array_splice($imagePaths, $index, 1);
        $images->update(['planned' => json_encode($imagePaths)]);

        return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
    }

    return response()->json(['success' => false, 'message' => 'Image not found.'], 404);
}





    public function account_order_details(Request $request): View|RedirectResponse
    {
        $order = $this->order->with(['deliveryManReview', 'customer', 'offlinePayments','details.productAllStatus'])
            ->where(['id' => $request['id'], 'customer_id' => auth('customer')->id(), 'is_guest' => '0'])
            ->first();

        if ($order) {
            $order?->details?->map(function ($detail) use ($order) {
                $order['total_qty'] += $detail->qty;

                $reviews = Review::where(['product_id' => $detail['product_id'], 'customer_id' => auth('customer')->id()])->whereNull('delivery_man_id')->get();
                $reviewData = null;
                foreach ($reviews as $review) {
                    if ($review->order_id == $detail->order_id) {
                        $reviewData = $review;
                    }
                }

                if (isset($reviews[0]) && is_null($reviewData)) {
                    $reviewData = ($reviews[0]['order_id'] == null ? $reviews[0] : null);
                }
                $detail['reviewData'] = $reviewData;
                return $order;
            });
            return view(VIEW_FILE_NAMES['account_order_details'], [
                'order' => $order,
                'refund_day_limit' => getWebConfig(name: 'refund_day_limit'),
                'current_date' => Carbon::now(),
            ]);
        }

        Toastr::warning(translate('invalid_order'));
        return redirect()->route('account-oder');
    }

    public function account_order_details_seller_info(Request $request)
    {
        $order = $this->order->with(['seller.shop'])->find($request->id);
        if (!$order) {
            Toastr::warning(translate('invalid_order'));
            return redirect()->route('account-oder');
        }

        $productIds = $this->product->active()->where(['added_by' => $order->seller_is])->where('user_id', $order->seller_id)->pluck('id')->toArray();
        $rating = $this->review->active()->whereIn('product_id', $productIds);
        $rating_count = $rating->count();
        $avg_rating = $rating->avg('rating');
        $product_count = count($productIds);

        $vendorRattingStatusPositive = 0;
        foreach ($rating->pluck('rating') as $singleRating) {
            ($singleRating >= 4 ? ($vendorRattingStatusPositive++) : '');
        }

        $rating_percentage = $rating_count != 0 ? ($vendorRattingStatusPositive * 100) / $rating_count : 0;

        return view(VIEW_FILE_NAMES['seller_info'], compact('avg_rating', 'product_count', 'rating_count', 'order', 'rating_percentage'));

    }

    public function account_order_details_delivery_man_info(Request $request)
    {

        $order = $this->order->with(['verificationImages', 'details.product', 'deliveryMan.rating', 'deliveryManReview', 'deliveryMan' => function ($query) {
            return $query->withCount('review');
        }])->find($request->id);

        if (!$order) {
            Toastr::warning(translate('invalid_order'));
            return redirect()->route('account-oder');
        }

        if (theme_root_path() == 'theme_fashion' || theme_root_path() == 'default') {
            foreach ($order->details as $details) {
                if ($details->product) {
                    if ($details->product->product_type == 'physical') {
                        $order['product_type_check'] = $details->product->product_type;
                        break;
                    } else {
                        $order['product_type_check'] = $details->product->product_type;
                    }
                }
            }
        }

        $delivered_count = $this->order->where(['order_status' => 'delivered', 'delivery_man_id' => $order->delivery_man_id, 'delivery_type' => 'self_delivery'])->count();

        return view(VIEW_FILE_NAMES['delivery_man_info'], compact('delivered_count', 'order'));
    }

    public function getAccountOrderDetailsReviewsView(Request $request): View|RedirectResponse
    {
        $order = $this->order->with(['deliveryManReview', 'customer', 'offlinePayments', 'details'])
            ->where(['id' => $request['id'], 'customer_id' => auth('customer')->id(), 'is_guest' => '0'])
            ->first();
        if ($order) {
            $order?->details?->map(function ($detail) use ($order) {
                $order['total_qty'] += $detail->qty;
                $reviews = Review::with('reply')
                    ->where(['product_id' => $detail['product_id'], 'customer_id' => auth('customer')->id()])
                    ->whereNull('delivery_man_id')->get();
                $reviewData = null;
                foreach ($reviews as $review) {
                    if ($review->order_id == $detail->order_id) {
                        $reviewData = $review;
                    }
                }
                if (isset($reviews[0]) && !$reviewData) {
                    $reviewData = ($reviews[0]['order_id'] != null ? $reviews[0] : null);
                }
                $detail['reviewData'] = $reviewData;
                return $order;
            });

            return view(VIEW_FILE_NAMES['order_details_review'], compact('order'));
        }
        Toastr::warning(translate('invalid_order'));
        return redirect()->route('account-oder');
    }


    public function account_wishlist()
    {
        if (auth('customer')->check()) {
            $wishlists = Wishlist::where('customer_id', auth('customer')->id())->get();
            return view('web-views.products.wishlist', compact('wishlists'));
        } else {
            return redirect()->route('home');
        }
    }

    public function account_tickets()
    {
        if (auth('customer')->check()) {
            $supportTickets = SupportTicket::where('customer_id', auth('customer')->id())->latest()->paginate(10);
            return view(VIEW_FILE_NAMES['account_tickets'], compact('supportTickets'));
        } else {
            return redirect()->route('home');
        }
    }

    public function submitSupportTicket(Request $request): RedirectResponse
    {
        $request->validate([
            'ticket_subject' => 'required',
            'ticket_type' => 'required',
            'ticket_priority' => 'required',
            'ticket_description' => 'required_without_all:image.*',
            'image.*' => 'required_without_all:ticket_description|image|mimes:jpeg,png,jpg,gif|max:6000',
        ], [
            'ticket_subject.required' => translate('The_ticket_subject_is_required'),
            'ticket_type.required' => translate('The_ticket_type_is_required'),
            'ticket_priority.required' => translate('The_ticket_priority_is_required'),
            'ticket_description.required_without_all' => translate('Either_a_ticket_description_or_an_image_is_required'),
            'image.*.required_without_all' => translate('Either_a_ticket_description_or_an_image_is_required'),
            'image.*.image' => translate('The_file_must_be_an_image'),
            'image.*.mimes' => translate('The_file_must_be_of_type:_jpeg,_png,_jpg,_gif'),
            'image.*.max' => translate('The_image_must_not_exceed_6_MB'),
        ]);

        $images = [];
        if ($request->file('image')) {
            foreach ($request['image'] as $key => $value) {
                $image_name = ImageManager::upload('support-ticket/', 'webp', $value);
                $images[] = [
                    'file_name' => $image_name,
                    'storage' => getWebConfig(name: 'storage_connection_type') ?? 'public',
                ];
            }
        }

        $ticket = [
            'subject' => $request['ticket_subject'],
            'type' => $request['ticket_type'],
            'customer_id' => auth('customer')->check() ? auth('customer')->id() : null,
            'priority' => $request['ticket_priority'],
            'description' => $request['ticket_description'],
            'attachment' => json_encode($images),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('support_tickets')->insert($ticket);
        return back();
    }

    public function single_ticket(Request $request)
    {
        $ticket = SupportTicket::with(['conversations' => function ($query) {
            $query->when(theme_root_path() == 'default', function ($sub_query) {
                $sub_query->orderBy('id', 'desc');
            });
        }])->where('id', $request->id)->first();
        return view(VIEW_FILE_NAMES['ticket_view'], compact('ticket'));
    }

    public function comment_submit(Request $request, $id)
    {
        if ($request->file('image') == null && empty($request['comment'])) {
            Toastr::error(translate('type_something') . '!');
            return back();
        }

        DB::table('support_tickets')->where(['id' => $id])->update([
            'status' => 'open',
            'updated_at' => now(),
        ]);

        $image = [];
        if ($request->file('image')) {
            $validator = $request->validate([
                'image.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:6000'
            ]);
            foreach ($request->image as $key => $value) {
                $image_name = ImageManager::upload('support-ticket/', 'webp', $value);
                $image[] = [
                    'file_name' => $image_name,
                    'storage' => getWebConfig(name: 'storage_connection_type') ?? 'public',
                ];
            }
        }
        $data =[
            'customer_message' => $request->comment,
            'attachment' => $image,
            'support_ticket_id' => $id,
            'position' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        SupportTicketConv::create($data);
        Toastr::success(translate('message_send_successfully') . '!');
        return back();
    }

    public function support_ticket_close($id)
    {
        DB::table('support_tickets')->where(['id' => $id])->update([
            'status' => 'close',
            'updated_at' => now(),
        ]);
        Toastr::success(translate('ticket_closed') . '!');
        return redirect('/account-tickets');
    }


    public function support_ticket_delete(Request $request)
    {

        if (auth('customer')->check()) {
            $support = SupportTicket::find($request->id);

            if ($support->attachment && count(json_decode($support->attachment)) > 0) {
                foreach (json_decode($support->attachment, true) as $image) {
                    ImageManager::delete('/support-ticket/' . $image);
                }
            }

            foreach ($support->conversations as $conversation) {
                if ($conversation->attachment && count(json_decode($conversation->attachment)) > 0) {
                    foreach (json_decode($conversation->attachment, true) as $image) {
                        ImageManager::delete('/support-ticket/' . $image);
                    }
                }
            }
            $support->conversations()->delete();

            $support->delete();
            return redirect()->back();
        } else {
            return redirect()->back();
        }

    }

    public function track_order(): View
    {
        $robotsMetaContentData = $this->robotsMetaContentRepo->getFirstWhere(params: ['page_name' => 'track-order']);
        if (!$robotsMetaContentData) {
            $robotsMetaContentData = $this->robotsMetaContentRepo->getFirstWhere(params: ['page_name' => 'default']);
        }
        return view(VIEW_FILE_NAMES['tracking-page'], [
            'robotsMetaContentData' => $robotsMetaContentData
        ]);
    }

    public function track_order_wise_result(Request $request)
    {
        if (auth('customer')->check()) {
            $orderDetails = Order::with('orderDetails')->where('id', $request['order_id'])->whereHas('details', function ($query) {
                $query->where('customer_id', (auth('customer')->id()));
            })->first();

            if (!$orderDetails) {
                Toastr::warning(translate('invalid_order'));
                return redirect()->route('account-oder');
            }

            $isOrderOnlyDigital = self::getCheckIsOrderOnlyDigital($orderDetails);
            return view(VIEW_FILE_NAMES['track_order_wise_result'], compact('orderDetails', 'isOrderOnlyDigital'));
        }
        return back();
    }

    public function getCheckIsOrderOnlyDigital($order): bool
    {
        $isOrderOnlyDigital = true;
        if ($order->orderDetails) {
            foreach ($order->orderDetails as $detail) {
                $product = json_decode($detail->product_details, true);
                if (isset($product['product_type']) && $product['product_type'] == 'physical') {
                    $isOrderOnlyDigital = false;
                }
            }
        }
        return $isOrderOnlyDigital;
    }

    public function track_order_result(Request $request)
    {
        $isOrderOnlyDigital = false;
        $user = auth('customer')->user();
        $user_phone = $request['phone_number'] ?? '';

        if (!isset($user)) {
            $userInfo = User::where('phone', $request['phone_number'])->orWhere('phone', 'like', "%{$request['phone_number']}%")->first();
            $order = Order::where('id', $request['order_id'])->first();

            if ($order && $order->is_guest) {
                $orderDetails = Order::with('shippingAddress')
                    ->where('id', $request['order_id'])
                    ->first();

                $orderDetails = ($orderDetails && $orderDetails->shippingAddress && $orderDetails->shippingAddress->phone == $request['phone_number']) ? $orderDetails : null;

                if (!$orderDetails) {
                    $orderDetails = Order::where('id', $request['order_id'])
                        ->whereHas('billingAddress', function ($query) use ($request) {
                            $query->where('phone', $request['phone_number']);
                        })->first();
                }
            } elseif ($userInfo) {
                $orderDetails = Order::where('id', $request['order_id'])->whereHas('details', function ($query) use ($userInfo) {
                    $query->where('customer_id', $userInfo->id);
                })->first();
            } else {
                Toastr::error(translate('invalid_Order_Id_or_phone_Number'));
                return redirect()->route('track-order.index', ['order_id' => $request['order_id'], 'phone_number' => $request['phone_number']]);
            }

        } else {
            $order = Order::where('id', $request['order_id'])->first();
            if ($order && $order->is_guest) {
                $orderDetails = Order::where('id', $request['order_id'])->whereHas('shippingAddress', function ($query) use ($request) {
                    $query->where('phone', $request['phone_number']);
                })->first();

            } elseif ($user->phone == $request['phone_number']) {
                $orderDetails = Order::where('id', $request['order_id'])->whereHas('details', function ($query) {
                    $query->where('customer_id', auth('customer')->id());
                })->first();
            }

            if ($request['from_order_details'] == 1) {
                $orderDetails = Order::where('id', $request['order_id'])->whereHas('details', function ($query) {
                    $query->where('customer_id', auth('customer')->id());
                })->first();
            }
        }

        $order_verification_status = getWebConfig(name: 'order_verification');

        if (isset($orderDetails)) {
            if ($orderDetails['order_type'] == 'POS') {
                Toastr::error(translate('this_order_is_created_by_') . ($orderDetails['seller_is'] == 'seller' ? 'vendor' : 'admin') . translate('_from POS') . ',' . translate('please_contact_with_') . ($orderDetails['seller_is'] == 'seller' ? 'vendor' : 'admin') . translate('_to_know_more_details') . '.');
                return redirect()->back();
            }
            $isOrderOnlyDigital = self::getCheckIsOrderOnlyDigital($orderDetails);
            return view(VIEW_FILE_NAMES['track_order'], compact('orderDetails', 'user_phone', 'order_verification_status', 'isOrderOnlyDigital'));
        }

        Toastr::error(translate('invalid_Order_Id_or_phone_Number'));
        return redirect()->route('track-order.index', ['order_id' => $request['order_id'], 'phone_number' => $request['phone_number']]);
    }

    public function track_last_order()
    {
        $orderDetails = OrderManager::track_order(Order::where('customer_id', auth('customer')->id())->latest()->first()->id);

        if ($orderDetails != null) {
            return view('web-views.order.tracking', compact('orderDetails'));
        } else {
            return redirect()->route('track-order.index')->with('Error', translate('invalid_Order_Id_or_phone_Number'));
        }

    }







    public function add_license()
    {

//        return view(VIEW_FILE_NAMES['user_profile'], compact('customer_detail',  'wishlists', 'total_order', 'total_loyalty_point', 'total_wallet_balance'));

$user = auth('customer')->user()->id;


 $users=User:: where("id",auth('customer')->user()->id)->first();


       $agnet=Agent:: where("user_id",auth('customer')->user()->id)->first();

    //   if (!$agnet) {
        

    //     return redirect()->route('zones-main');   
    //  } 

        return view('web-views.users-profile.add-license', compact('user','agnet','users'));
    }


    public function check_license(Request $request)
    {







        // التحقق من المدخلات
        $request->validate([
            'adLicenseNumber' => 'required|string',
            'entityType' => 'required|in:individual,organization',
            'advertiserId' => 'required',
        ]);




        $adLicenseNumber = $request->input('adLicenseNumber');
        $entityType = $request->input('entityType');
        $advertiserId = $request->input('advertiserId');
        $entityTypeInt = ($entityType === 'individual') ? 1 : 2;




        if (Estate::where('ad_license_number',$adLicenseNumber)->exists()) {


            return back()->withErrors(['adLicenseNumber' =>'الإعلان موجود مسبقًا']);
        }
     $url = "https://integration-gw.nhc.sa/nhc/prod/v2/brokerage/AdvertisementValidator";

        // $url = "https://integration-gw.housingapps.sa/nhc/dev/v2/brokerage/AdvertisementValidator";

        // send Ruquest to  API
        $response = Http::withHeaders([
              'X-IBM-Client-Id' => 'b4952cd30458e51546b3a9ab24c3fd22',
              'X-IBM-Client-Secret' => 'b64ec4f278d661809b101c039c66e79b',

            // 'X-IBM-Client-Id' => '77ade3ca8d69a99f37a92afb79f07a67',
            // 'X-IBM-Client-Secret' => '3978f6284fa6cad973f080627fe980da',
            'RefId' => '0',
        ])->get($url, [
            'adLicenseNumber' => $adLicenseNumber,
            'advertiserId' => $advertiserId,
            'idType' => $entityTypeInt,
        ]);


   
        // معالجة الاستجابة
        if ($response->ok()) {
            $data = $response->json();
            
            
          






            if ($data['Body']['result']['isValid']) {
                // استخراج البيانات
                // return $data['Body']['result'];
                $advertisement = $data['Body']['result']['advertisement'];
                $location = $advertisement['location'];
 

                session([
                    'adLicenseNumber' => $advertisement['adLicenseNumber'],
                    'advertiserId' => $advertisement['advertiserId'],
                    'deedNumber' => $advertisement['deedNumber'],
                    
                     'propertyFace' => $advertisement['propertyFace'],
                    



                    'advertiserName' => $advertisement['advertiserName'],
                    'phoneNumber' => $advertisement['phoneNumber'],
                    'brokerageAndMarketingLicenseNumber' => $advertisement['brokerageAndMarketingLicenseNumber'],
                    'isConstrained' => $advertisement['isConstrained'],
                    'isPawned' => $advertisement['isPawned'],
                    'isHalted' => $advertisement['isHalted'],
                    'isTestment' => $advertisement['isTestment'],
                    'rerConstraints' => $advertisement['rerConstraints'],
                    'streetWidth' => $advertisement['streetWidth'],
                    'propertyArea' => $advertisement['propertyArea'],
                    'propertyPrice' => $advertisement['propertyPrice'],
                    'landTotalPrice' => $advertisement['landTotalPrice'],
                    'landTotalAnnualRent' => $advertisement['landTotalAnnualRent'],
                    'numberOfRooms' => $advertisement['numberOfRooms'],
                    'propertyType' => $advertisement['propertyType'],
                    'propertyAge' => $advertisement['propertyAge'],
                    'advertisementType' => $advertisement['advertisementType'],
                    'location' => $advertisement['location'],
                    'propertyFace' => $advertisement['propertyFace'],
                    'planNumber' => $advertisement['planNumber'],
                    'landNumber' => $advertisement['landNumber'],
                    'obligationsOnTheProperty' => $advertisement['obligationsOnTheProperty'],
                    'guaranteesAndTheirDuration' => $advertisement['guaranteesAndTheirDuration'],
                    'complianceWithTheSaudiBuildingCode' => $advertisement['complianceWithTheSaudiBuildingCode'],
                    'channels' => $advertisement['channels'],
                    'propertyUsages' =>  $advertisement['propertyUsages'][0] ?? '',
                    'propertyUtilities' => $advertisement['propertyUtilities'],
                    'creationDate' => $advertisement['creationDate'],
                    'endDate' => $advertisement['endDate'],
                    'adLicenseUrl' => $advertisement['adLicenseUrl'],
                    'adSource' => $advertisement['adSource'],
                    
'obligationsOnTheProperty' => $advertisement['obligationsOnTheProperty'],
'guaranteesAndTheirDuration' => $advertisement['guaranteesAndTheirDuration'],
'locationDescriptionOnMOJDeed' => $advertisement['locationDescriptionOnMOJDeed'],
'numberOfRooms' => $advertisement['numberOfRooms'],
'mainLandUseTypeName' => $advertisement['mainLandUseTypeName'],
                    
                    'titleDeedTypeName' => $advertisement['titleDeedTypeName'],
                    'locationDescriptionOnMOJDeed' => $advertisement['locationDescriptionOnMOJDeed'],
                    'notes' => $advertisement['notes'],
                    // Borders
                    'north_limit_name' => $advertisement['borders']['northLimitName'] ?? null,
                    'north_limit_description' => $advertisement['borders']['northLimitDescription'] ?? null,
                    'north_limit_length_char' => $advertisement['borders']['northLimitLengthChar'] ?? null,
                    'east_limit_name' => $advertisement['borders']['eastLimitName'] ?? null,
                    'east_limit_description' => $advertisement['borders']['eastLimitDescription'] ?? null,
                    'east_limit_length_char' => $advertisement['borders']['eastLimitLengthChar'] ?? null,
                    'west_limit_name' => $advertisement['borders']['westLimitName'] ?? null,
                    'west_limit_description' => $advertisement['borders']['westLimitDescription'] ?? null,
                    'west_limit_length_char' => $advertisement['borders']['westLimitLengthChar'] ?? null,
                    'south_limit_name' => $advertisement['borders']['southLimitName'] ?? null,
                    'south_limit_description' => $advertisement['borders']['southLimitDescription'] ?? null,
                    'south_limit_length_char' => $advertisement['borders']['southLimitLengthChar'] ?? null,


                    // Location fields
                    'location_region' => $location['region'] ?? null,
                    'location_regionCode' => $location['regionCode'] ?? null,
                    'location_city' => $location['city'] ?? null,
                    'location_cityCode' => $location['cityCode'] ?? null,
                    'location_district' => $location['district'] ?? null,
                    'location_districtCode' => $location['districtCode'] ?? null,
                    'location_street' => $location['street'] ?? null,
                    'location_postalCode' => $location['postalCode'] ?? null,
                    'location_buildingNumber' => $location['buildingNumber'] ?? null,
                    'location_additionalNumber' => $location['additionalNumber'] ?? null,
                    'location_longitude' => $location['longitude'] ?? null,
                    'location_latitude' => $location['latitude'] ?? null,
                ]);



//                Advertisement::create([
//                    'adLicenseNumber' => $advertisement['adLicenseNumber'],
//                    'advertiserId' => $advertisement['advertiserId'],
//                    'advertiserName' => $advertisement['advertiserName'],
//                    'phoneNumber' => $advertisement['phoneNumber'],
//                    'brokerageAndMarketingLicenseNumber' => $advertisement['brokerageAndMarketingLicenseNumber'],
//                    'isConstrained' => $advertisement['isConstrained'],
//                    'isPawned' => $advertisement['isPawned'],
//                    'isHalted' => $advertisement['isHalted'],
//                    'isTestment' => $advertisement['isTestment'],
//                    'rerConstraints' => $advertisement['rerConstraints'],
//                    'streetWidth' => $advertisement['streetWidth'],
//                    'propertyArea' => $advertisement['propertyArea'],
//                    'propertyPrice' => $advertisement['propertyPrice'],
//                    'landTotalPrice' => $advertisement['landTotalPrice'],
//                    'landTotalAnnualRent' => $advertisement['landTotalAnnualRent'],
//                    'numberOfRooms' => $advertisement['numberOfRooms'],
//                    'propertyType' => $advertisement['propertyType'],
//                    'propertyAge' => $advertisement['propertyAge'],
//                    'advertisementType' => $advertisement['advertisementType'],
//                    'location' => $advertisement['location'],
//                    'propertyFace' => $advertisement['propertyFace'],
//                    'planNumber' => $advertisement['planNumber'],
//                    'landNumber' => $advertisement['landNumber'],
//                    'obligationsOnTheProperty' => $advertisement['obligationsOnTheProperty'],
//                    'guaranteesAndTheirDuration' => $advertisement['guaranteesAndTheirDuration'],
//                    'complianceWithTheSaudiBuildingCode' => $advertisement['complianceWithTheSaudiBuildingCode'],
//                    'channels' => $advertisement['channels'],
//                    'propertyUsages' => $advertisement['propertyUsages'],
//                    'propertyUtilities' => $advertisement['propertyUtilities'],
//                    'creationDate' => $advertisement['creationDate'],
//                    'endDate' => $advertisement['endDate'],
//                    'adLicenseUrl' => $advertisement['adLicenseUrl'],
//                    'adSource' => $advertisement['adSource'],
//                    'titleDeedTypeName' => $advertisement['titleDeedTypeName'],
//                    'locationDescriptionOnMOJDeed' => $advertisement['locationDescriptionOnMOJDeed'],
//                    'notes' => $advertisement['notes'],

                //  'advertisement_id' => $advertisement->id,
//                        'north_limit_name' => $advertisement['borders']['northLimitName'],
//                        'north_limit_description' => $advertisement['borders']['northLimitDescription'],
//                        'north_limit_length_char' => $advertisement['borders']['northLimitLengthChar'],
//                        'east_limit_name' => $advertisement['borders']['eastLimitName'],
//                        'east_limit_description' => $advertisement['borders']['eastLimitDescription'],
//                        'east_limit_length_char' => $advertisement['borders']['eastLimitLengthChar'],
//                        'west_limit_name' => $advertisement['borders']['westLimitName'],
//                        'west_limit_description' => $advertisement['borders']['westLimitDescription'],
//                        'west_limit_length_char' => $advertisement['borders']['westLimitLengthChar'],
//                        'south_limit_name' => $advertisement['borders']['southLimitName'],
//                        'south_limit_description' => $advertisement['borders']['southLimitDescription'],
//                        'south_limit_length_char' => $advertisement['borders']['southLimitLengthChar'],
//
//                ]);
//



                // الترخيص صالح
                return redirect()->route('create-estate')->with('success', ' تم التحقق بنجاح رقم الترخيص صالح!');




            } else {
                // الترخيص غير صالح
                return back()->withErrors(['adLicenseNumber' => $data['Body']['result']['message']]);
            }
        }

        // حدث خطأ في الطلب
        return back()->withErrors(['adLicenseNumber' => 'حدث خطأ أثناء التحقق. حاول مرة أخرى.']);

    }







    public function store_ticket(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
    
        SupportTicket::create([
            'user_id' => auth('customer')->user()->id,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'open',
        ]);
    
        return redirect()->back()->with('success', 'تم إرسال التذكرة بنجاح');
    }



}
