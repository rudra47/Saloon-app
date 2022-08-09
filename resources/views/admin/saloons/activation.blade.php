<div>
    <form action="{{ route('app.admin.saloons.activationStore', $saloon->id) }}"
          class="form-horizontal" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12 mb-2">
                <select name="status" class="form-control">
                    <option value="1" {{$saloon->status == 1 ? 'selected' : ''}}>Active</option>
                    <option value="2" {{$saloon->status == 2 ? 'selected' : ''}}>Pending</option>
                    <option value="0" {{$saloon->status == 0 ? 'selected' : ''}}>Inactive</option>
                </select>
            </div>
        </div>
        <div class="col-md-3 offset-md-9 mt-2">
            <input type="submit" class="btn btn-primary btn-sm">
        </div>
    </form>
</div>
