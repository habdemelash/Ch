<link rel="stylesheet" href="{{ asset('amharic-date/css/redmond.calendars.picker.css') }}">

<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
<script src="{{ asset('amharic-date/js/jquery.plugin.js') }}"></script>

<script src="{{ asset('amharic-date/js/jquery.calendars.js') }}"></script>
<script src="{{ asset('amharic-date/js/popper.min.js') }}"></script>
{{-- <script src="{{ asset('amharic-date/js/jquery.calendars.all.js') }}"></script> --}}
<script src="{{ asset('amharic-date/js/jquery.calendars.plus.js') }}"></script>
<script src="{{ asset('amharic-date/js/jquery.calendars.picker.js') }}"></script>
<script src="{{ asset('amharic-date/js/jquery.calendars.pickerAm.js') }}"></script>
<script src="{{ asset('amharic-date/js/jquery.calendars.pickerOr.js') }}"></script>
<script src="{{ asset('amharic-date/js/jquery.calendars.ethiopian.js') }}"></script>
<script src="{{ asset('amharic-date/js/jquery.calendars.ethiopian-am.js') }}"></script>
<script src="{{ asset('amharic-date/js/jquery.calendars.ethiopian-or.js') }}"></script>
<script src="{{ asset('amharic-date/js/jquery.calendars.ethiopian-en.js') }}"></script>


<script>
$(function() {
	 var calendar = $.calendars.instance('ethiopian','am');
	$('#popupDatepicker').calendarsPickerAm({calendar: calendar, dateFormat: 'mm/dd/yyyy', yearRange: "0:+200"});
	
});

function showDate(date) {
	alert('The date chosen is ' + date);
}
</script>


<script type="text/javascript">
	
$('#defaultPopup').calendarsPicker({calendar: $.calendars.instance('gregorian')});

</script>
