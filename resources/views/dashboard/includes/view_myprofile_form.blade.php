<div class="row">
  <div class="col-md-8">
    <h2>My Profile</h2>
    <form class="form" method="POST" action="/dashboard/profile/update">
      {{ csrf_field() }}
      <div class="form-group">
        @include('dashboard.includes.error_or_success_message')
        <input id="username" type="text" class="validate form-control" value="{{ Auth::user()->username }}" name="username" placeholder="Username">
      </div>
      <div class="form-group">
        <input id="email" type="email" class="validate form-control" value="{{ Auth::user()->email }}" name="email" placeholder="Email">
      </div>
      <div class="form-group">
        <textarea id="description" class="form-control" name="profile_bio" placeholder="Background Information">{{ Auth::user()->profile_bio }}</textarea>
      </div>
      <div class="form-group">
        <button class="btn btn-primary" type="submit" name="action">Update
        <i class="material-icons right">update</i>
        </button>
      </div>
    </form>
  </div>
  <div class="col-md-4">
    <h2>Change Picture</h2>
    <form class="form" method="POST" action="/dashboard/picture/update" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group">
        <img src="{{ Auth::user()->picture_url }}" title="myprofile" alt="myprofile" class="img-circle my-pix">
      </div>
      <div class="form-group">
        <input id="picture_url" type="file" class="validate form-control" name="picture_url">
      </div>
      <div class="form-group">
        <button class="btn btn-primary" type="submit" name="action">Upload
        <i class="material-icons right">offline_pin</i>
        </button>
      </div>
    </form>
  </div>
</div>