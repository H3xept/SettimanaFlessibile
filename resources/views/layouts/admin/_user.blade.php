<li>
	<div class="panel panel-default">
	  <div class="panel-body">
		  <div class="name"><label for="">{{$user->name}} {{$user->surname}}</label>
			  <span class="label label-success">{{classtoroman($user->class)}}</span>
			  <span class="class hidden">{{$user->class}}</span>
			  <?php $role = $user->roles()->first()['name']; if($role == "Admin") $col = "danger"; else $col = "primary"; ?>
			  <span class="label label-{{$col}}">{{$role}}</span>
			  <div class="pull-right">
			  <span><a class="btn btn-primary btn-small" href="{{route('admin.editUser',['target_id'=>$user->id])}}"><i class="fa fa-pencil"></i></a></span>
			  </div>
		  </div>
	  </div>
	</div>
</li>