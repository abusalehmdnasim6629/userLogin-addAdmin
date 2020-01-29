<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}
</style>
</head>
<body>

        <h2 style="text-align:center">Admin Profile</h2>
        
        <div class="card">
        <h4>{{Session::get('admin_name')}}</h4>
        <h4>{{Session::get('admin_email')}}</h4>
        <h4>{{Session::get('admin_phone')}}</h4>
        </div>
        <?php 
        $admin_id = Session::get('admin_id');
        $result = DB::table('tbl_add')
                     ->join('tbl_user','tbl_add.user_id','=','tbl_user.user_id')
                     ->select('tbl_add.*','tbl_user.*')
                     ->where('admin_id',$admin_id)
                     ->orderBy('tbl_add.created_at')
                     ->get();
         
                  
        ?>
        <table align="center" style="border:1px solid black;">
          
          <tr style="border:1px solid black;">
            <td style="border:1px solid black;">Serial number</td>
            <td style="border:1px solid black;">User name</td>
          </tr>
          @foreach($result as $r)
          <tr style="border:1px solid black;">
            <td style="border:1px solid black;">{{$r->serial_no}}</td>
            <td style="border:1px solid black;">{{$r->user_name}}</td>
          </tr>
          @endforeach
        
        </table>
        
        <a class="btn btn-primary" href="{{URL::to('/admin-logout')}}" role="button">Logout</a>
        
</body>
</html>
