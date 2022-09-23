<div>
    <form action="{{ route('app.saloon.bookings.confirmationStore', $booking->id) }}"
          class="form-horizontal" method="post">
        @csrf
        <div class="row">
            @if($booking->status == 1 || $booking->status == 3)
            <div class="col-md-12 mb-2">
                <select name="status" class="form-control">
                    <option value="3">Active</option>
                    @if($booking->status == 3)
                    <option value="4">Complete</option>
                    @endif
                </select>
            </div>
            @endif
            @if($booking->status == 0)
            <div class="col-md-12">
                <input type="datetime-local" class="form-control" value="{{$booking->booking_apply_time}}" name="booking_confirm_time" required>
            </div>
            @endif
        </div>
        <div class="col-md-3 offset-md-9 mt-2">
            <input type="submit" class="btn btn-primary btn-sm">
        </div>
    </form>
</div>
