<script>
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
    });
    $.ajax({
       url: `{{ route('forReservationExtend') }}`,
       type: 'GET',
       success: function(response){
          if(response.status == 200){
            $('#extendReservationModal').modal('show');
            $('#headerMessage').text(response.message);
            //TODO append reservation details
            $('#roomImage').attr('src', `../${response.data.file_path}`);
            
            $('#reservationDetails').html(`
                <h3 class="mb-3">Room Number: ${response.data.number}</h3>
                <p class="mb-3"><strong>Price:</strong> $${response.data.price}</p>
                <p class="mb-3"><strong>Description:</strong> ${response.data.description}</p>

                <p class="mb-3"><strong>Check-in:</strong> ${response.data.check_in}</p>
                <p class="mb-3"><strong>Check-out:</strong> <input class="form-control"data-reservation-id="${response.data.id}" type="date" id="checkOutDate" value="${response.data.check_out}" /></p>
            `);

            console.log(response.data);
          }
       }
    });

    function extendReservation( id, date) {
        $.ajax({
            url: "{{ route('extendReservation') }}",
            type: 'POST',
            data: {
                id: id,
                date: date
            },
            success: function(response){
                if(response.status == 200){
                    $('#extendReservationModal').modal('hide');
                    toastr.success(response.message);
                }
            }
        });
    }

    $(document).ready(function(){
        let g_newCheckOutDate;
        let g_reservationId;
        $(document).on('click', '#bookNowLink', function(e) {
            e.preventDefault();
            var checkin = $('input[name="checkin"]').val();
            var checkout = $('input[name="checkout"]').val();
            sessionStorage.setItem('checkIn', checkin);
            sessionStorage.setItem('checkOut', checkout);
            sessionStorage.setItem('bookNowClicked', 'true');

            window.location.href = "{{ route('usersLogin') }}";
        });

        $(document).on('change', '#checkOutDate', function(e) {
            let newCheckOutDate = $(this).val();
            let reservationId = $(this).data('reservation-id');
            let currentDate = new Date().toISOString().split('T')[0];
            if (newCheckOutDate >= currentDate) {
                g_newCheckOutDate = newCheckOutDate;
                g_reservationId = reservationId;
                $('#reservationExtend').removeAttr('disabled');
            } 
        });

        $(document).on('click', '#reservationExtend', function(e) {
            e.preventDefault();
            console.log({g_newCheckOutDate, g_reservationId});
        });
    });

 </script>