$header
	<article>
		<header>
			<h2>
				<img src="templates/{$theme}/assets/img/icons/categories_big.png" alt="" />&nbsp;
				{$lng['menue']['ticket']['categories']}
			</h2>
		</header>

		<section>
			
			<form action="{$linker->getLink(array('section' => 'tickets'))}" method="post" enctype="application/x-www-form-urlencoded">

			<div class="overviewsearch">
				{$searchcode}
			</div>

			<if 15 < $categories_count >
			<div class="overviewadd">
				<img src="templates/{$theme}/assets/img/icons/categories_add.png" alt="" />&nbsp;
				<a href="{$linker->getLink(array('section' => 'tickets', 'page' => 'categories', 'action' => 'addcategory'))}">{$lng['ticket']['ticket_newcateory']}</a>
			</div>
			</if>

			<table class="bradius" <if 0 < $categories_count>id="sortable"</if>>
			<thead>
				<tr>
					<th>{$lng['ticket']['category']}</th>
					<th>{$lng['ticket']['logicalorder']}</th>
					<th>{$lng['ticket']['ticketcount']}</if></th>
					<th class="nosort">{$lng['panel']['options']}</th>
				</tr>
			</thead>
			<if $pagingcode != ''>
				<tfoot>
					<tr>
						<td colspan="4">{$pagingcode}</td>
					</tr>
				</tfoot>
			</if>
			<tbody>
				$ticketcategories
			</tbody>
			</table>

			<p style="display:none;">
				<input type="hidden" name="s" value="$s"/>
				<input type="hidden" name="page" value="$page"/>
				<input type="hidden" name="send" value="send" />
			</p>

			</form>

			<div class="overviewadd">
				<img src="templates/{$theme}/assets/img/icons/categories_add.png" alt="" />&nbsp;
				<a href="{$linker->getLink(array('section' => 'tickets', 'page' => 'categories', 'action' => 'addcategory'))}">{$lng['ticket']['ticket_newcateory']}</a>
			</div>

		</section>

	</article>
$footer

