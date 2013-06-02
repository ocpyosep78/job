<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<?php $this->load->view( 'panel/common/navigation' ); ?>

<div class="container-fluid" id="content">
	<?php $this->load->view( 'panel/common/sidebar' ); ?>
	<div id="main">
		<div class="container-fluid">
			<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<?php $this->load->view( 'panel/common/modul_name', array( 'name' => 'Profile', 'class' => 'icon-edit' ) ); ?>
							
							<div class="box-content">
								<form action="#" method="POST" class='form-horizontal'>
									<div class="control-group">
										<label for="textfield" class="control-label">Text input</label>
										<div class="controls">
											<input type="text" name="textfield" id="textfield" class="input-xlarge">
											<span class="help-block">This is just a supporting text</span>
										</div>
									</div>
									<div class="control-group">
										<label for="password" class="control-label">Password</label>
										<div class="controls">
											<input type="password" name="password" id="password" placeholder="*********" class="input-xlarge">
											<span class="help-block">Minimum length: 9, only numeric</span>
										</div>
									</div>
									<div class="control-group">
										<label for="file" class="control-label">File-input</label>
										<div class="controls">
											<input type="file" name="file" id="file" class="input-block-level">
											<span class="help-block">Only .jpg (Max Size: 100MB)</span>
										</div>
									</div>
									<div class="control-group">
										<label for="select" class="control-label">Select</label>
										<div class="controls">
											<select name="select" id="select" class='input-large'>
												<option value="1">Option-1</option>
												<option value="2">Option-2</option>
												<option value="3">Option-3</option>
												<option value="4">Option-4</option>
												<option value="5">Option-5</option>
												<option value="6">Option-6</option>
												<option value="7">Option-7</option>
												<option value="8">Option-8</option>
												<option value="9">Option-9</option>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Checkboxes</label>
										<div class="controls">
											<label class='checkbox'>
												<input type="checkbox" name="checkbox"> Lorem ipsum eiusmod
											</label>
											<label class='checkbox'>
												<input type="checkbox" name="checkbox"> ipsum eiusmod
											</label>
											<label class='checkbox'>
												<input type="checkbox" name="checkbox"> Eiusmod lorem ipsum
											</label>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Radios</label>
										<div class="controls">
											<label class='radio'>
												<input type="radio" name="radio"> Lorem
											</label>
											<label class='radio'>
												<input type="radio" name="radio"> Ipsum
											</label>
											<label class='radio'>
												<input type="radio" name="radio"> Eiusmod
											</label>
										</div>
									</div>
									<div class="control-group">
										<label for="textarea" class="control-label">Textarea</label>
										<div class="controls">
											<textarea name="textarea" id="textarea" class="input-block-level">Lorem ipsum mollit minim fugiat tempor dolore sit officia ut dolore. </textarea>
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Save changes</button>
										<button type="button" class="btn">Cancel</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
		</div>
	</div></div>
</body>
</html>