<h3>Iscriviti al corso <span><small><a href="/help" class=""><i class="fa fa-info-circle"> Aiuto?</i></a></small></span>
<span class="pull-right"><i class="fa fa-user-plus"></i></span>
</h3>
<div style="font-size:18px;">Seleziona il colore corrispondente agli appelli nei quali ci si desidera iscrivere.</div>
<br>
<div align="center">
    @for($c = 0; $c < 3; $c++)
    <div class="radio-inline">
      <label>
        <input type="radio" name="color" id="color" value="{{$c+1}}" required {!! $course->disabledCheck($c+1) !!}> <?php echo itoc_s($c+1) ?>
      </label>
    </div>
    @endfor
</div>

<hr>

<table class='table table-bordered'>
    <thead>
        <tr>
            <th>Fasce</th>
            <th>Lunedì</th>
            <th>Martedì</th>
            <th>Giovedì</th>
        </tr>
    </thead>
    <tbody>
        @for($c = 0; $c < 3; $c++)
    
            <tr>
            <td>{!!($c+1)."°"!!}</td>
            @for($in = 0; $in < 3; $in++)
                <?php 
                $stripe = $course->stripes()->where('stripe_number','=',(($c+1)+3*$in))->first();
                if($stripe){
                    if($course->isStripeFull($stripe)) {
                        $msg = "<div class='label label-warning pull-right'>Pieno!</div>";
                    }
                    else {
                        $msg = "<div class='label label-primary pull-right'>".$course->n_studentsSignedInStripeCall($stripe->stripe_call)."/".$course->maxStudentsPerStripe."</div> ";
                    }

                    $eval = itoc($stripe->stripe_call).$msg;
                }
                else 
                    $eval = itoc(0);
                ?>
                <td>{!!$eval!!}</td>
            @endfor
            </tr>

        @endfor
    </tbody>
</table>