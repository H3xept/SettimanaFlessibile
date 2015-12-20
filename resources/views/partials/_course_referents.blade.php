<h3>Referenti<span class="pull-right"><i class="fa fa-users"></i></span></h3><hr>
<p style="font-size:16px;">
  @foreach($course->referents as $referent)
    <label class="label label-success">{{$referent->name.$referent->surname}}</label>
  @endforeach
</p>