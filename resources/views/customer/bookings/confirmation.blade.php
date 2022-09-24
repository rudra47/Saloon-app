<div>
    <form action="{{ route('bookings.confirmationStore', $booking->id) }}"
          class="form-horizontal" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <input type="text" class="form-control"  name="transaction_no" placeholder="Enter payment transaction ID" required>
            </div>
        </div>
        <div class="col-md-3 offset-md-9 mt-2">
            <input type="submit" class="btn btn-primary btn-sm">
        </div>
    </form>
</div>
