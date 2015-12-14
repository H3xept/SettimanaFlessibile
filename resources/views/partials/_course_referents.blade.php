<h4>Referenti<span class="pull-right"><i class="fa fa-users"></i></span></h4><hr>
<p style="font-size:16px;">
  @foreach($course->referents as $referent)
    <label class="label label-success">{{$referent->name.$referent->surname}}</label>
  @endforeach
</p>