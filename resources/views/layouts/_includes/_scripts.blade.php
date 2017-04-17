<!-- Mainly scripts -->
<script src="/js/jquery-3.1.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="/js/inspinia.js"></script>
<script src="/js/plugins/pace/pace.min.js"></script>
<script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Toastr script -->
<script src="/js/plugins/toastr/toastr.min.js"></script>

@yield('script')


@if(Session::has('flash_message'))
<script type="text/javascript">
    $(function () {
        var vClass = "{{ Session::get('flash_message')['class'] }}";
        var vTitle = "{{ Session::get('flash_message')['title'] }}";
        var vMsg = "{{ Session::get('flash_message')['msg'] }}";

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "progressBar": true,
            "preventDuplicates": false,
            "positionClass": "toast-top-center",
            "onclick": null,
            "showDuration": "400",
            "hideDuration": "1000",
            "timeOut": "7000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        toastr[vClass](vMsg, vTitle);
    });

</script>
@endif
<script type="text/javascript">
    var i = 0;

    $( "#easter" ).click(function() {
        i++;

        if (i==1) $( this ).css('color', 'pink');
        if (i==2) $( this ).css('color', 'blue');
        if (i==3) $( this ).css('color', 'red');
        if (i==4) $( this ).css('color', 'orange');
        if (i==5) $( this ).css('color', 'yellow');
        if (i==6) $( this ).css('color', 'purple');

        if (i==7) {
            i=0;
            $( this ).css('color', 'black');
            $('.easter-container').show();
            $('.welcome-container').hide();
            startGame();
        }
    });

</script>
