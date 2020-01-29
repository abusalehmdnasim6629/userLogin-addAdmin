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

        <h2 style="text-align:center">User Profile</h2>
        
        <div class="card">
        <p class="alert-success">{{Session::get('success')}}</p>
        <?php Session::put('success',null);?>
        <p class="alert-danger">{{Session::get('unsuccess')}}</p>
        <?php Session::put('unsuccess',null);?>
        <h4>{{Session::get('user_name')}}</h4>
        <h4>{{Session::get('user_email')}}</h4>
        <h4>{{Session::get('user_phone')}}</h4>
        </div>

        <?php
        $result = DB::table('tbl_admin')->select('tbl_admin.*')->get();    
        ?>
        <h4><b> Add Admin:</b></h4>
        <br>
        @foreach($result as $r)
          <?php $user_id = Session::get('user_id'); ?>  
          
          <a class="btn btn-primary" href="{{URL::to('/add-admin/'.$r->admin_id.$user_id ?? '')}}" role="button">{{$r->admin_name}}</a>
  
        @endforeach  

        <h4><b>Already Added with:</b></h4>
        <br>
        <?php $result1 = DB::table('tbl_add')
                        ->join('tbl_admin','tbl_add.admin_id','=','tbl_admin.admin_id')  
                        ->where('user_id',$user_id ?? '')
                        ->select('tbl_add.serial_no','tbl_admin.admin_name')
                        ->get();
        
        ?>
        <table align="center" style="border:1px solid black;">
            <tr style="border:1px solid black;">
               <td style="border:1px solid black;">Serial Number</td>
               <td style="border:1px solid black;">Admin Name</td>
            </tr>
            @foreach($result1 as $r1)
            <tr style="border:1px solid black;">
               <td style="border:1px solid black;">{{$r1->serial_no}}</td>
               <td style="border:1px solid black;">{{$r1->admin_name}}</td>
            </tr>
            @endforeach
        </table>

        
        <a class="btn btn-primary" href="{{URL::to('/user-logout')}}" role="button">Logout</a>
        
        
</body>
</html>
