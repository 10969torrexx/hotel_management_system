<div id="extendReservationModal" class="modal fade" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="exampleModalToggleLabel">Reservation Notification
            <p style="margin-top: 10px;">To extend your stay, update the <i><strong>checkout date</strong></i> and click <i><strong>Extend Reservation</strong></i>. If not, simply click <i><strong>Confirm Checkout</strong></i>.</p>
          </h1>
        </div>
        <div class="modal-body">
            <h3 id="headerMessage"></h3>
            <div class="row">
                <div class="col-sm-6">
                    <img src="" id="roomImage" class="img-fluid" alt="Responsive image">
                </div>
                <div class="col-sm-6" id="reservationDetails">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" disabled id="reservationExtend" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Extend Reservation?</button>
            <button type="button" class="btn btn-danger" id="reservationCheckout" data-bs-dismiss="modal">Confirm Checkout</button>
        </div>
      </div>
    </div>
</div>