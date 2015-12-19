<h3>Iscriviti al corso <span><small><a href="" class=""><i class="fa fa-info-circle"> Aiuto?</i></a></small></span>
<span class="pull-right"><i class="fa fa-user-plus"></i></span>
</h3>
<div style="font-size:18px;">Seleziona il colore corrispondente agli appelli nei quali ci si desidera iscrivere.</div>
<br>
<div align="center">
    <div class="radio-inline">
      <label>
        <input type="radio" name="color" id="color" value="1" required {!! $course->disabledCheck(1) !!}> Verde
      </label>
    </div>
    <div class="radio-inline">
      <label>
        <input type="radio" name="color" id="color" value="2" {!! $course->disabledCheck(2) !!}> Giallo
      </label>
    </div>
    <div class="radio-inline">
      <label>
        <input type="radio" name="color" id="color" value="3" {!! $course->disabledCheck(3) !!}> Blu
      </label>
    </div>
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
                if($stripe)
                    $eval = $stripe->stripe_call;
                else 
                    $eval = 0;
                ?>
                <td>{!!itoc($eval)!!}</td>
            @endfor
            </tr>

        @endfor
    </tbody>
</table>