<h3>Programmazione corso <span><small><a href="/help" class=""><i class="fa fa-info-circle"> Aiuto?</i></a></small></span>
<span class="pull-right"><i class="fa fa-table"></i></span>
</h3><hr>

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