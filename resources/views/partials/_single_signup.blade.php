<h3>Iscriviti al corso <span><small><a href="/help" class=""><i class="fa fa-info-circle"> Aiuto?</i></a></small></span>
<span class="pull-right"><i class="fa fa-user-plus"></i></span>
</h3> <div style="font-size:18px;">Seleziona la fascia nella quale ci si desidera iscrivere.</div> <hr>

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
                        $enabled = "disabled";
                        $msg = "<div class='label label-warning pull-right'>Pieno!</div>";
                    }
                    else {
                        $enabled = "";
                        $msg = "<div class='label label-primary pull-right'>".$course->n_studentsSignedInStripeCall($stripe->stripe_call)."/".$course->maxStudentsPerStripe."</div> ";
                    }
                    $eval = '<input type="checkbox" name="f'.$stripe->stripe_number.'" id="f'.$stripe->stripe_number.'" value="1" '.$enabled.'>'.$msg;
                }
                else 
                    $eval = '<span></span>'
                ?>
                <td>{!!$eval!!}</td>
            @endfor
            </tr>

        @endfor
    </tbody>
</table>