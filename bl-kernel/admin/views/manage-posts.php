<?php

HTML::title(array('title'=>$L->g('Manage posts'), 'icon'=>'folder'));

echo '<a href="'.HTML_PATH_ADMIN_ROOT.'new-post"><i class="uk-icon-plus"></i> '.$L->g('Add a new post').'</a>';

echo '
<table class="uk-table uk-table-striped">
<thead>
	<tr>
	<th>'.$L->g('Title').'</th>
	<th class="uk-text-center">'.$L->g('Published date').'</th>
	<th>'.$L->g('Friendly URL').'</th>
	</tr>
</thead>
<tbody>
';

	foreach($posts as $Post)
	{
		$status = false;
		if($Post->scheduled()) {
			$status = $Language->g('Scheduled');
		}
		elseif(!$Post->published()) {
			$status = $Language->g('Draft');
		}

		echo '<tr>';
		echo '<td><a href="'.HTML_PATH_ADMIN_ROOT.'edit-post/'.$Post->key().'">'.($status?'<span class="label-draft">'.$status.'</span>':'').($Post->title()?$Post->title():'<span class="label-empty-title">'.$Language->g('Empty title').'</span> ').'</a></td>';
		echo '<td class="uk-text-center">'.$Post->dateRaw().'</td>';

		$friendlyURL = Text::isEmpty($Url->filters('post')) ? '/'.$Post->key() : '/'.$Url->filters('post').'/'.$Post->key();

		echo '<td><a target="_blank" href="'.$Post->permalink().'">'.$friendlyURL.'</a></td>';
		echo '</tr>';
	}

echo '
</tbody>
</table>
';

?>

<div id="paginator">
<ul>
<?php
	if(Paginator::get('showNewer')) {
		echo '<li class="previous"><a href="'.HTML_PATH_ADMIN_ROOT.'manage-posts?page='.Paginator::get('prevPage').'">« '.$Language->g('Prev page').'</a></li>';
	}

	echo '<li class="list">'.(Paginator::get('currentPage')+1).' / '.(Paginator::get('numberOfPages')+1).'</li>';

	if(Paginator::get('showOlder')) {
		echo '<li class="next"><a href="'.HTML_PATH_ADMIN_ROOT.'manage-posts?page='.Paginator::get('nextPage').'">'.$Language->g('Next page').' »</a></li>';
	}
?>
</ul>
</div>
