<div>
    <form action="{{ route('app.saloon.bookings.confirmationStore', $booking->id) }}"
          class="form-horizontal" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12 mb-2">
                <select name="status" class="form-control">
                    <option value="1" {{$booking->status == 1 ? 'selected' : ''}}>Active</option>
                    <option value="2" {{$booking->status == 2 ? 'selected' : ''}}>Pending</option>
                    <option value="0" {{$booking->status == 0 ? 'selected' : ''}}>Inactive</option>
                </select>
            </div>
            <div class="col-md-12">
                <input type="datetime-local" class="form-control" name="booking_confirm_time" required>
            </div>
        </div>
        <div class="col-md-3 offset-md-9 mt-2">
            <input type="submit" class="btn btn-primary btn-sm">
        </div>
    </form>
</div>
