<!DOCTYPE html>
<html lang="en">
<head>
  @include('dashboard.includes.links_and_metadata')
  <title>Dashboard :: Welcome home</title>
</head>
<body>
  @include('dashboard.includes.side_nav')
  <main>
    @include('dashboard.includes.top_nav')
    <div class="row">
     <div class="col s12 m12">
      <div class="card small">
       <div class="card-content">
        <span class="card-title activator grey-text text-darken-4">Welcome <i class="material-icons">perm_identity</i>
         <i class="material-icons right">more_vert</i></span>
         <p>Here is some more information about this product that is only revealed once clicked on.</p>
       </div>
       <div class="card-reveal">
        <span class="card-title grey-text text-darken-4">Courseware<i class="material-icons right">close</i></span>
        <p>Here is some more information about this product that is only revealed once clicked on.</p>
      </div>
    </div>
  </div>
</div>
</main>    
@include('dashboard.includes.footer')
</body>
</html>