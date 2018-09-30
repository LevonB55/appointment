
//select page cancel/confirm collapse
$(".select-page-wrapper .available-time").click(function(){
  $(this).parents('.available-time-wrap').find('.confirm').collapse('show');
});
$(".select-page-wrapper .cancel").click(function(){
  $(this).parents('.available-time-wrap').find('.confirm').collapse('hide');
});

//appointsbook details button/content collapse
$('.appointsbook-page-wrapper .cancel-appoint').click(function() {
	$(this).find('.details').toggle();
	$(this).find('.closed').toggle();
	$(this).parents('.appoint-block').find('.details-content').collapse('toggle');
});

function bootDatePicker() {
	let dateInput = $('#birthday');
	let options = {
		format: 'dd/mm/yyyy',
		todayHighlight: true,
		autoclose: true,
		endDate: '+1d',
		datesDisabled: '+1d'
	};
	dateInput.datepicker(options);
}

bootDatePicker();

$('#datetimepicker').datetimepicker({  
  minDate:new Date(),
  disabledDates: [new Date()]
});

$('#search').on('keyup', function() {
	if($(this).val().trim().length > 0) {		
			$.ajax({
			type : 'GET',
			url: 'doctor/search',
			data: {search: $(this).val()},
			success: function(data) {
	        let doctors = JSON.parse(data);
	        let doctorsList = '', avatar = profession = null;                        
	        $.each(doctors, function(key,value) {
	        	if(value.avatar) {
	        			avatar = value.avatar
	        	} else {
	        			avatar = (value.gender === 'male') ? 'avatar_male.png' : 'avatar_female.png';
	        	}
	      		doctorsList += `
	      			<a class="dropdown-item search-item" href="//localhost:3000/user/${value.id}" target="_blank">
	        				<img src="//localhost:3000/storage/images/${avatar}" alt="avatar" class="mr-2 shadow avatar">
	        				${value.fname} ${value.lname}&#160;&#160;&#160; ${emptyNull(value.profession)}
	      			</a>`;      		
	        });
	        
	      	$('.search-dropdown').html(doctorsList);
	    }
			});
	} else {
		$('.search-dropdown').empty();
	}	
});

function  emptyNull(value) {
    return (value == null) ? "" : value
}