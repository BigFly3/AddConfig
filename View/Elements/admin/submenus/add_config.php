<?php
/**
 * [ADMIN] AddConfig
 *
 * @link			https://github.com/BigFly3/AddConfig
 * @author			BigFly3
 * @package			AddConfig
 * @license			MIT
 */
?>
<tr>
	<th>メニュー</th>
	<td>
		<ul>
			<li><?php $this->BcBaser->link($crumbs[0]['name'], ['admin' => true, 'plugin' => 'add_config', 'controller' => 'add_configs', 'action'=>'form']) ?></li>
			<li><?php $this->BcBaser->link('登録一覧', ['admin' => true, 'plugin' => 'add_config', 'controller' => 'add_configs', 'action'=>'index']) ?></li>
		</ul>
	</td>
</tr>
