<x-front-layout>
    @push('css')
        <link rel="stylesheet" href="{{ asset('css/notificatons.css') }}">
    @endpush

    <section id="content">
        <h6>Notifications</h6>
        <div class="notificationsDiv">
            @if (count($notifications) > 0)
                @foreach ($notifications as $notification)
                    <div class="card pr-3" id="{{ $notification->id }}">
                        <div class="notificationDiv" id="{{ $notification->id }}">
                            <div class="card-body">
                                <strong class="card-title">{{ $notification->data['subject'] }}</strong>
                                <p class="card-text">{{ $notification->data['message'] }}</p>
                            </div>

                            <div class="actionDiv">
                                <i class="fa-solid fa-check text-success" id="markAsRead"
                                    notificationID="{{ $notification->id }}"></i>
                            </div>
                        </div>

                        <p class="text-danger text-right">{{ $notification->created_at }}</p>
                    </div>
                @endforeach
            @else
                <p class="text-center pt-3">No new notifications</p>
            @endif
        </div>
    </section>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $(document).on('click', '#markAsRead', function() {
                    var notID = $(this).attr('notificationID');

                    $.ajax({
                        url: "{{ route('read-notification') }}",
                        method: "post",
                        dataType: "json",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "_method": "post",
                            'notID': notID,
                        },
                        success: function(res) {

                            if (res.status === true) {
                                $('div#' + notID).remove();
                            } else {
                                // alert(res.msg);
                            }
                        }
                    })
                });
            });
        </script>
    @endpush
</x-front-layout>
