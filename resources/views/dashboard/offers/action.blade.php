@if (request()->is('admin/offers'))
<a href="{{ route('offers.edit',$row->id) }}" class="btn btn-success">تعديل</a>
<a href="" class="btn btn-danger">حذف</a>
<a href="{{ route('send.offer.page',$row->id) }}" class="btn btn-dark">أرسال عرض</a>
@else
<a href="{{ route("offers.edit",$row->id) }}" class="btn btn-success">تعديل</a>
@endif