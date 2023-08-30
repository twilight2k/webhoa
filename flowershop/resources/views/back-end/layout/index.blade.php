<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Quản lý Website Wendy Flowers</title>
    <base href="{{asset(' ')}}"/>
    <link rel="shortcut icon" type="image/png" href="client_asset/assets/dest/img/favicon_manager.png"/>
    <!-- Custom fonts for this template-->
    <link href="admin_asset/assets/dest/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="admin_asset/assets/dest/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="admin_asset/assets/dest/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('back-end.layout.header')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('back-end.layout.topbar')

                @yield('content')

            </div>
            <!-- End of Main Content -->

            @include('back-end.layout.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sẵn sàng rời đi?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Chọn "Đăng xuất" bên dưới nếu bạn đã sẵn sàng kết thúc phiên hiện tại của mình.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Thoát</button>
                    <a class="btn btn-primary" href="admin/logout">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="admin_asset/assets/dest/vendor/jquery/jquery.min.js"></script>
    <script src="admin_asset/assets/dest/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="admin_asset/assets/dest/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="admin_asset/assets/dest/js/sb-admin-2.min.js"></script>
    @yield('js')
    <!-- Page level plugins -->
    <script src="admin_asset/assets/dest/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="admin_asset/assets/dest/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="admin_asset/assets/dest/js/demo/datatables-demo.js"></script>
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
    var options = {
        filebrowserImageBrowseUrl: '/flowershop/public/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/flowershop/public/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/flowershop/public/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/flowershop/public/laravel-filemanager/upload?type=Files&_token='
    };
    </script>
    <script>
        CKEDITOR.replace('my-editor', options);
    </script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        function fromNow(date, nowDate = Date.now(), rft = new Intl.RelativeTimeFormat(undefined, { numeric: "auto" })) {
            const SECOND = 1000;
            const MINUTE = 60 * SECOND;
            const HOUR = 60 * MINUTE;
            const DAY = 24 * HOUR;
            const WEEK = 7 * DAY;
            const MONTH = 30 * DAY;
            const YEAR = 365 * DAY;
            const intervals = [
                { ge: YEAR, divisor: YEAR, unit: 'year' },
                { ge: MONTH, divisor: MONTH, unit: 'month' },
                { ge: WEEK, divisor: WEEK, unit: 'week' },
                { ge: DAY, divisor: DAY, unit: 'day' },
                { ge: HOUR, divisor: HOUR, unit: 'hour' },
                { ge: MINUTE, divisor: MINUTE, unit: 'minute' },
                { ge: 30 * SECOND, divisor: SECOND, unit: 'seconds' },
                { ge: 0, divisor: 1, text: 'just now' },
            ];
            const now = typeof nowDate === 'object' ? nowDate.getTime() : new Date(nowDate).getTime();
            const diff = now - (typeof date === 'object' ? date : new Date(date)).getTime();
            const diffAbs = Math.abs(diff);
            for (const interval of intervals) {
                if (diffAbs >= interval.ge) {
                    const x = Math.round(Math.abs(diff) / interval.divisor);
                    const isFuture = diff < 0;
                    return interval.unit ? rft.format(isFuture ? x : -x, interval.unit) : interval.text;
                }
            }
        }

        var notificationsWrapper   = $('.dropdown-notifications');
        var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
        var notificationsCountElem = notificationsToggle.find('i[data-count]');
        var notificationsCount     = parseInt(notificationsCountElem.data('count'));
        var notifications          = notificationsWrapper.find('.menu-notification');
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('6c0ffd045a97cd18cf4a', {
        cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            var existingNotifications = notifications.html();
            // alert(JSON.stringify(data));
            var newNotificationHtml = `
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="admin_asset/assets/dest/img/undraw_profile_1.svg"
                            alt="">
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <div class="font-weight-bold">
                        <div class="text-truncate">`+data.contact.description+`</div>
                        <div class="small text-gray-500">`+data.contact.name+`</div>
                        <div class="small text-gray-500">`+fromNow(data.contact.created_at)+`</div>
                    </div>
                </a>
            `;

            notifications.html(newNotificationHtml + existingNotifications);

            notificationsCount += 1;
            notificationsCountElem.attr('data-count', notificationsCount);
            notificationsWrapper.find('.notif-count').text(notificationsCount);
            notificationsWrapper.show();
        });

    </script>
    <script>
        function fromNow(date, nowDate = Date.now(), rft = new Intl.RelativeTimeFormat(undefined, { numeric: "auto" })) {
            const SECOND = 1000;
            const MINUTE = 60 * SECOND;
            const HOUR = 60 * MINUTE;
            const DAY = 24 * HOUR;
            const WEEK = 7 * DAY;
            const MONTH = 30 * DAY;
            const YEAR = 365 * DAY;
            const intervals = [
                { ge: YEAR, divisor: YEAR, unit: 'year' },
                { ge: MONTH, divisor: MONTH, unit: 'month' },
                { ge: WEEK, divisor: WEEK, unit: 'week' },
                { ge: DAY, divisor: DAY, unit: 'day' },
                { ge: HOUR, divisor: HOUR, unit: 'hour' },
                { ge: MINUTE, divisor: MINUTE, unit: 'minute' },
                { ge: 30 * SECOND, divisor: SECOND, unit: 'seconds' },
                { ge: 0, divisor: 1, text: 'just now' },
            ];
            const now = typeof nowDate === 'object' ? nowDate.getTime() : new Date(nowDate).getTime();
            const diff = now - (typeof date === 'object' ? date : new Date(date)).getTime();
            const diffAbs = Math.abs(diff);
            for (const interval of intervals) {
                if (diffAbs >= interval.ge) {
                    const x = Math.round(Math.abs(diff) / interval.divisor);
                    const isFuture = diff < 0;
                    return interval.unit ? rft.format(isFuture ? x : -x, interval.unit) : interval.text;
                }
            }
        }
        var notifWrapper   = $('.dropdown-not');
        var notifToggle    = notifWrapper.find('a[data-toggle]');
        var notifCountElem = notifToggle.find('i[data-count]');
        var notifCount     = parseInt(notifCountElem.data('count'));
        var notif          = notifWrapper.find('.menu-not');
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('6c0ffd045a97cd18cf4a', {
        cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel-customer');
        channel.bind('my-event-customer', function(data) {
            var existingNotif = notif.html();
            // alert(JSON.stringify(data));
            var newNotifHtml = `
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-success">
                            <i class="fas fa-donate text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">`+fromNow(data.customer.created_at)+`</div>
                        <span>Có đơn hàng mới từ </span>`+data.customer.name+`
                    </div>
                </a>
            `;

            notif.html(newNotifHtml + existingNotif);

            notifCount += 1;
            notifCountElem.attr('data-count', notifCount);
            notifWrapper.find('.notif').text(notifCount);
            notifWrapper.show();
        });
    </script>
</body>

</html>
