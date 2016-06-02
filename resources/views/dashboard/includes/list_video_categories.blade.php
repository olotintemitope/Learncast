<div class="row">
  <div class="col-md-12">
    <h2>View Uploaded Video Categories</h2>
    <ul class="nav nav-tabs">
      <li role="presentation" class="active">
        <a data-toggle="tab" href="#active_categories">Active Categories</a>
      </li>
      <li class="tabs col s3">
        <a data-toggle="tab" href="#pending_categories">Pending Categories</a>
      </li>
    </ul>
  </div>
  <div class="tab-content">
    <div id="active_categories" class="col-md-12 tab-pane active">
      @if ($categories->count() > 0)
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th data-field="id">Sn</th>
            <th data-field="id">Name</th>
            <th data-field="name">Edit</th>
            <th data-field="price">Status</th>
          </tr>g
        </thead>
        <tbody>
          @foreach($categories as $index => $category)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $category->name }}</td>
            <td>
              <span>
                <a href="/dashboard/category/edit/{{ $category->id }}" title="{{ $category->name }}" id="{{ $category->id }}">Edit <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
              </span>
            </td>
            <td>
              <select id="{{ $category->id }}" name="activate" class="activate form-control">
                <option value="" selected>Select</option>
                <option value="0">De-activate</option>
              </select>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
      <h5>You do not have any active video category</h5>
      @endif
      {!! $categories->render() !!}
    </div>
    <div id="pending_categories" class="col-md-12 tab-pane fade">
      @if ($pendingCategories->count() > 0)
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th data-field="id">Sn</th>
            <th data-field="id">Name</th>
            <th data-field="price">Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pendingCategories as $index => $category)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $category->name }}</td>
            <td>
              <select id="{{ $category->id }}" name="activate" class="activate form-control">
                <option value="" selected>Select</option>
                <option value="1">Activate</option>
              </select>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
      <h5>You do not have any pending video category</h5>
      @endif
      {!! $pendingCategories->render() !!}
    </div>
  </div>
</div>
</div>