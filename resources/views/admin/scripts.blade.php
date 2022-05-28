<script src="{{ asset('amharic-date/js/jquery.plugin.js') }}"></script>
<script src="{{ asset('amharic-date/js/jquery.calendars.js') }}"></script>
<script src="{{ asset('amharic-date/js/popper.min.js') }}"></script>
<script src="{{ asset('amharic-date/js/jquery.calendars.plus.js') }}"></script>
<script src="{{ asset('amharic-date/js/jquery.calendars.picker.js') }}"></script>
<script src="{{ asset('amharic-date/js/jquery.calendars.pickerAm.js') }}"></script>
<script src="{{ asset('amharic-date/js/jquery.calendars.pickerOr.js') }}"></script>
<script src="{{ asset('amharic-date/js/jquery.calendars.ethiopian.js') }}"></script>
<script src="{{ asset('amharic-date/js/jquery.calendars.ethiopian-am.js') }}"></script>
<script src="{{ asset('amharic-date/js/jquery.calendars.ethiopian-or.js') }}"></script>
<script src="{{ asset('amharic-date/js/jquery.calendars.ethiopian-en.js') }}"></script>
<script src="{{ asset('amharic-date/js/jquery.timepicker.min.js') }}"></script>
<script src="{{ asset('amharic-date/clockers/js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('amharic-date/clockers/js/cpo.js') }}"></script>
<script type="text/javascript" src="{{ asset('amharic-date/clockers/js/cpa.js') }}"></script>
<script type="text/javascript" src="{{ asset('amharic-date/clockers/js/cpe.js') }}"></script>

<script>
    $(function() {
        var calendar = $.calendars.instance('ethiopian', 'am');
        $('#amharic').calendarsPickerAm({
            calendar: calendar,
            dateFormat: 'yyyy-mm-dd',
            yearRange: "0:+200"
        });
    });
</script>


<script>
    $(function() {
        var calendar = $.calendars.instance('ethiopian', 'or');
        $('#oromic').calendarsPickerOr({
            calendar: calendar,
            dateFormat: 'yyyy-mm-dd',
            yearRange: "0:+200"
        });

    });
</script>


<script type="text/javascript">
    $('#gregorian').calendarsPicker({
        calendar: $.calendars.instance('gregorian'),
        dateFormat: 'yyyy-mm-dd'
    });
</script>


<script type="text/javascript">
    $('.amharic-start-time').cpa({
        autoclose: true,
        amOrPm: " ቀን",
        twelvehour: true
    });

    $('.oromic-start-time').cpo({
        autoclose: true,
        amOrPm: " Ga",
        twelvehour: true
    });
    $('.english-start-time').cpe({
        autoclose: true,
        amOrPm: " PM",
        twelvehour: true
    });
</script>

<script type="text/javascript">
    $('.amharic-end-time').cpa({
        autoclose: true,
        amOrPm: " ቀን",
        twelvehour: true
    });
    $('.oromic-end-time').cpo({
        autoclose: true,
        amOrPm: " Ga",
        twelvehour: true
    });
    $('.english-end-time').cpe({
        autoclose: true,
        amOrPm: " PM",
        twelvehour: true
    });
</script>
