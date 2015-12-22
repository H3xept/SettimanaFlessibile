<h3>Referenti<span class="pull-right"><i class="fa fa-users"></i></span></h3><hr>
<p style="font-size:16px;">
  @foreach($course->reflist() as $referent)
    <label class="label label-success">{{$referent}}</label>
  @endforeach
</p>