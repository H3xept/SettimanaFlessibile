<h3>Iscriviti al corso <span><small><a href="" class=""><i class="fa fa-info-circle"> Aiuto?</i></a></small></span>
<span class="pull-right"><i class="fa fa-table"></i></span>
</h3> <div style="font-size:18px;">Seleziona la casella dove si desidera iscriversi.</div> <hr>

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
                    $eval = '<input type="checkbox" name="f'.$stripe->stripe_number.'" id="f'.$stripe->stripe_number.'" value="1">';
                else 
                    $eval = '<span></span>'
                ?>
                <td>{!!$eval!!}</td>
            @endfor
            </tr>

        @endfor
    </tbody>
</table>