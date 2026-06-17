@foreach($conversations as $conv)
    {{-- {{ dd($conv) }} --}}
    @php($user= $conv->sender_type == 'admin' ? $conv->receiver :  $conv->sender)
    @if ($user)
    @php($unchecked=($conv->last_message->sender_id == $user->id) ? $conv->unread_message_count : 0)


    <div class="mt-2">
                    <a href="#" class="d-flex align-items-start"   onclick="viewConvs('{{route('message.view',['conversation_id'=>$conv->id,'user_id'=>$user->id])}}','customer-{{$user->id}}','{{ $conv->id }}','{{ $user->id }}')"
            id="customer-{{$user->id}}">
                        <img class="d-flex me-3 rounded-circle"  src="{{asset('storage/app/public/profile/'.$user['image'])}}"
                        onerror="this.src='{{asset('assets/admin')}}/img/160x160/img1.jpg'"

                             alt="Generic placeholder image" height="36">
                        <div class="flex-1 chat-user-box">
                            <p class="user-title m-0">{{$user['name']}}</p>
                            <p class="text-muted">{{ $user['phone'] }}</p>
                        </div>
                    </a>



                </div>




        <!-- <div
            class="chat-user-info d-flex border-bottom p-3 align-items-center customer-list {{$unchecked ? 'conv-active' : ''}}"
            onclick="viewConvs('{{route('message.view',['conversation_id'=>$conv->id,'user_id'=>$user->id])}}','customer-{{$user->id}}','{{ $conv->id }}','{{ $user->id }}')"
            id="customer-{{$user->id}}">
            <div class="chat-user-info-img d-none d-md-block">
                <img class="avatar-img"
                        src="{{asset('storage/app/public/profile/'.$user['image'])}}"
                        onerror="this.src='{{asset('assets/admin')}}/img/160x160/img1.jpg'"
                        alt="Image Description">
            </div>
            <div class="chat-user-info-content">
                <h5 class="mb-0 d-flex justify-content-between">
                    <span class=" mr-3">{{$user['name'].' '.$user['name']}}</span> <span
                        class="{{$unchecked ? 'badge badge-info' : ''}}">{{$unchecked ? $unchecked : ''}}</span>
                </h5>
                <span>{{ $user['phone'] }}</span>
            </div>
        </div> -->
    @else
        <div
            class="chat-user-info d-flex border-bottom p-3 align-items-center customer-list">
            <div class="chat-user-info-img d-none d-md-block">
            <img class="d-flex me-3 rounded-circle"  src="{{asset('assets/admin')}}/img/160x160/img1.jpg"
                        onerror="this.src='{{asset('assets/admin')}}/img/160x160/img1.jpg'"
                        alt="Generic placeholder image" height="36">
            </div>
            <div class="chat-user-info-content">
                <h5 class="mb-0 d-flex justify-content-between">
                    <span class=" mr-3">المستخدم لايوجد</span>
                </h5>
            </div>
        </div>
    @endif
@endforeach



{{--<div class="mail-list mt-4">--}}
{{--    <a href="#" class="active"><i class="mdi mdi-email-outline me-2"></i> Inbox <span--}}
{{--            class="ms-1 float-end">(18)</span></a>--}}
{{--    <a href="#"><i class="mdi mdi-star-outline me-2"></i>Starred</a>--}}
{{--    <a href="#"><i class="mdi mdi-diamond-stone me-2"></i>Important</a>--}}
{{--    <a href="#"><i class="mdi mdi-file-outline me-2"></i>Draft</a>--}}
{{--    <a href="#"><i class="mdi mdi-email-check-outline me-2"></i>Sent Mail</a>--}}
{{--    <a href="#"><i class="mdi mdi-trash-can-outline me-2"></i>Trash</a>--}}
{{--</div>--}}
