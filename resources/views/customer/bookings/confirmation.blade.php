<div>
    <form action="{{ route('bookings.confirmationStore', $booking->id) }}"
          class="form-horizontal" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <span style="font-weight: bold; color: #000;">Amount to be paid: <span style="color: red;">BDT {{ $booking->price*30/100 }}</span></span>
                <input style="margin-top: 20px;" type="text" class="form-control"  name="transaction_no" placeholder="Enter payment transaction ID" required>
            </div>
        </div>
        <div class="col-md-3 offset-md-9 mt-2">
            <input type="submit" class="btn btn-primary btn-sm">
        </div>
    </form>
</div>
