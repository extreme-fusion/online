<ul class="breadcrumbs">
	<li><a href="<?php echo $this->router->path(array('module' => 'forum')); ?>"><?php echo __('Forum'); ?></a></li>
	<li><a href="<?php echo $this->router->path(array('module' => 'forum')); ?>#board-<?php echo $thread['board_id']; ?>"><?php echo $thread['board']; ?></a></li>
	<li><a href="<?php echo $this->router->path(array('module' => 'forum', 'controller' => 'category', $thread['category_id'])); ?>"><?php echo $thread['category']; ?></a></li>
	<li><a href="<?php echo $this->router->path(array('module' => 'forum', 'controller' => 'thread', $thread['id'])); ?>"><?php echo $thread['title']; ?></a></li>
	<li class="active"><?php echo __('Edit thread'); ?></li>
</ul>
<?php $this->theme->middlePanel(__('Forum')); ?>
		<form action="<?php echo URL_REQUEST; ?>" method="post" id="thread-edit">
			<div class="tbl1">
				<div class="formLabel col col-2"><label for="title"><?php echo __('Thread title'); ?>:</label></div>
				<div class="formField col col-8">
					<input type="text" name="title" value="<?php echo $thread['title']; ?>" id="title">
				</div>
			</div>
			<div class="tbl2">
				<div class="formLabel col col-2"><label for="content"><?php echo __('Entry content'); ?>:</label></div>
				<div class="formField col col-8">
					<textarea name="content" rows="10" id="content"><?php echo $thread['entry']; ?></textarea>
				</div>
			</div>
			<div class="tbl1">
				<div class="line center">
					<?php foreach ($bbcodes as $bbcode): ?>
					<button type="button" onClick="addText('content', '[<?php echo $bbcode['value']; ?>]', '[/<?php echo $bbcode['value']; ?>]', 'thread-edit');">
						<img src="<?php echo $bbcode['image']; ?>" title="<?php echo $bbcode['description']; ?>" alt="<?php echo $bbcode['description']; ?>">
					</button>
					<?php endforeach; ?>
				</div>
				<div class="line center">
					<?php foreach ($smileys as $smiley): ?>
					<img src="<?php echo ADDR_IMAGES; ?>smiley/<?php echo $smiley['image']; ?>" title="<?php echo $smiley['text']; ?>" alt="<?php echo $smiley['text']; ?>" onclick="insertText('content', '<?php echo $smiley['code']; ?>', 'thread-edit');">
					<?php endforeach; ?>
				</div>
			</div>
			<?php if ($this->user->iADMIN()): ?>
			<div class="tbl2">
				<div class="line center">
					<label><input type="checkbox" name="is_pinned"<?php if ($thread['is_pinned']): ?> checked<?php endif; ?>> <?php echo __('Pin this thread'); ?></label>
				</div>
			</div>
			<?php endif; ?>
			<div class="tbl center">
				<input type="submit" value="<?php echo __('Save changes'); ?>" class="button">
			</div>
		</form>
<?php $this->theme->middlePanel(); ?>