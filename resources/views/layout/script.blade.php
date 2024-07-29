<<<<<<< HEAD
<!-- Required Js -->
<script src="{{asset('assets/theme2/js/vendor-all.min.js')}}"></script>
<script src="{{asset('assets/theme2/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/theme2/js/ripple.js')}}"></script>
<script src="{{asset('assets/theme2/js/pcoded.min.js')}}"></script>

<!-- Apex Chart -->
<script src="{{asset('assets/theme2/js/plugins/apexcharts.min.js')}}"></script>


<!-- custom-chart js -->
<script src="{{asset('assets/theme2/js/pages/dashboard-main.js')}}"></script>
=======
<!-- App js -->
<script src=" {{asset('assets/theme/js/vendor.js')}}"></script>
<script src=" {{asset('assets/theme/js/app.js')}}"></script>

<!-- Knob charts js -->
<script src="{{ asset('assets/theme/libs/jquery-knob/jquery.knob.min.js')}}"></script>

<!-- Sparkline Js-->
<script src="{{ asset('assets/theme/libs/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

<script src="{{ asset('assets/theme/libs/morris.js/morris.min.js')}}"></script>

<script src="{{ asset('assets/theme/libs/raphael/raphael.min.js')}}"></script>

<!-- Dashboard init-->
<script src=" {{asset('assets/theme/js/pages/dashboard.js')}}"></script>
>>>>>>> f822cf6 (updation in the)

<!-- Datatable -->
<script src="{{ asset('assets/theme/libs/datatable/js/dataTables.min.js')}}"></script>
<script src="{{ asset('assets/theme/libs/datatable/js/dataTables.bootstrap5.min.js')}}"></script>

<!-- Dropzone -->
<script src="{{ asset('assets/theme/libs/dropzone/min/dropzone.min.js')}}"></script>

<<<<<<< HEAD
<!-- daterange -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

=======
>>>>>>> f822cf6 (updation in the)
<script>
    $('.read-all-notification').click(function() {
        $.ajax({
            url: '{{ route('notifications.read_all') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },

            success: function(response) {
                if(response.status === 'success') {
                    $('.notification-count-badge').text('0');
                    $('.notify-content').remove();
                    console.log('All notifications marked as read.');
                }
            },
            error: function(xhr) {
                console.error('An error occurred:', xhr.responseText);
            }
        });
    });
</script>
