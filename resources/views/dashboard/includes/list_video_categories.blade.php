<div class="card-panel hoverable">
 <div class="row">
  <div class="col s12">
    <ul class="tabs">
      <li class="tabs col s3"><a class="active" href="#active_categories">Active Categories</a></li>
      <li class="tabs col s3"><a class="" href="#pending_categories">Pending Categories</a></li>
    </ul>
  </div>
  <div id="active_categories" class="col s12">
    <table class="bordered responsive-table">
      <thead>
        <tr>
          <th data-field="id">Sn</th>
          <th data-field="id">Name</th>
          <th data-field="name">Edit</th>
          <th data-field="price">Status</th>
        </tr>
      </thead>
      <tbody>
      <?php $sn = 1; ?>
        @foreach($categories as $category)
        <tr>
          <td>{{ $sn }}</td>
          <td>{{ $category->name }}</td>
          <td>
           <span>
            <a href="/dashboard/category/edit/{{ $category->id }}" title="{{ $category->name }}" id="{{ $category->id }}">Edit <i class="fa fa-pencil" aria-hidden="true"></i> 
            </a>
          </span>
        </td>
        <td>
         <select id="{{ $category->id }}" name="activate" class="activate">
          <option value="" selected>Select</option>
          <option value="0">De-activate</option>
        </select>
      </td>
    </tr>
    <?php $sn++; ?>
    @endforeach
  </tbody>
</table>
{!! $categories->render() !!}
</div>
<div id="pending_categories" class="col s12">
  <table class="bordered responsive-table">
    <thead>
      <tr>
        <th data-field="id">Sn</th>
        <th data-field="id">Name</th>
        <th data-field="price">Status</th>
      </tr>
    </thead>
    <tbody>
    <?php $sn = 1; ?>
      @foreach($pendingCategories as $category)
      <tr>
        <td>{{ $sn }}</td>
        <td>{{ $category->name }}</td>
        <td>
         <select id="{{ $category->id }}" name="activate" class="activate">
          <option value="" selected>Select</option>
          <option value="1">Activate</option>
        </select>
      </td>
    </tr>
    <?php $sn++; ?>
    @endforeach
  </tbody>
</table>
{!! $pendingCategories->render() !!}
</div>
</div>
</div>