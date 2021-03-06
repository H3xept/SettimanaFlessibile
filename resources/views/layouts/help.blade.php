@extends('layouts.master')
@section('content')

<div class="jumbotron contrast">

<h3>Corsi disponibili</h3>
<p>la prima cosa da fare è scegliere i corsi che vorrai frequentare, facendo attenzione a non scegliere più di un corso per fascia per evitare una sovrapposizione.</p><hr>
<h3>I corsi possono essere: </h3>
<ul>
	<li>A fascia singola: un corso che dura due ore
	</li>
	<li>A fascia doppia: un corso che dura quattro ore
	</li>
	<li>Giornaliero: un corso che occupa tutto il giorno ( a fascia tripla)
	</li>
	<li>Progressivo a  fascia singola : un corso che occupa una stessa fascia per tutti e tre i giorni
	</li>
	<li>Progressivo a fascia doppia : un corso che occupa due fasce consecutive  al giorno (ad esempio la prima e la seconda fascia) per tutti e tre i giorni
	</li>
	<li>Progressivo a fascia tripla: un corso che occupa tutte e tre le fasce per tutti e tre i giorni (giornaliero progressivo)
	</li>
</ul><br>
<div class="alert alert-warning" role="alert"> Ogni colore corrisponde ad un appello, quindi scegliendo un colore ti inscriverai a tutte le fasce (del corso) corrispondenti a quel colore.</div>
<br>
<i><h5>Potrai vedere i corsi ai quali ti sei iscritto cliccando sull’icona “Profilo”</h5></i>
<hr>
<h4>Profilo</h4>
<p>Sulla pagina del profilo troverai l’agenda relativa ai corsi ai quali ti sei iscritto che  potrà essere modificata  in caso di iscrizione errata. Cliccando l’icona del cestino a destra del nome del corso potrai rimuovere l’iscrizione al corso che non vuoi frequentare, cosi da poterti inscrivere (tornando su “corsi disponibili”) ad un nuovo corso.</p>

<div class="alert alert-danger" role="alert">
	<b>ATTENZIONE:</b> la tua iscrizione sarà completa quando nell’agenda del tuo “profilo” risulterai iscritto a tutte le fasce .
</div>

</div>

@stop

@section('list_menu')
<a href="{{route('home')}}" class="list-group-item">
Profilo
</a>
<a href="{{route('courses')}}" class="list-group-item">Corsi disponibili</a>
<a href="#" class="list-group-item disabled">Istruzioni</a>
@stop
