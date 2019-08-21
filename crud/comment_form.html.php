<div class="container">
	<h1 class="text-center mb-5">Comment Form</h1>
	<form id="newComment" class="mr-3" novalidate data-toggle="new-comment" data-url="<?= BASE_URL ?>/api/comment" data-target="#commentList .alert:first" method="POST">
		<div class="row">
			<div class="form-group col-6">
				<div class="row align-items-center">
					<label for="email" class="col-4 text-right mr-3">Email*</label>
					<input name="email" id="email" type="email" class="form-control col" required autocomplete="off">
					<div class="invalid-feedback col-8 offset-4"></div>
				</div>
			</div>
			<div class="form-group col-6">
				<div class="row align-items-center">
					<label for="name" class="col-4 text-center">Name*</label>
					<input name="name" id="name" type="text" class="form-control col" required autocomplete="off">
					<div class="invalid-feedback col-8 offset-4"></div>
				</div>
			</div>
			<div class="form-group col-12">
				<div class="row">
					<label for="comment" class="col-2 text-right mr-3">Comment*</label>
					<textarea name="comment" id="comment" class="form-control col" required></textarea>
					<div class="invalid-feedback col-10 offset-2"></div>
				</div>
			</div>
			<div class="form-group col-12">
				<div class="row">
					<div class="col-2"></div>
					<div class="col-auto">
						<button type="submit" name="submit" class="btn btn-secondary">Submit</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>