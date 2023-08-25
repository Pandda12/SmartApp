<?php
get_header();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<div id="smart-app-custom-form-container">
			<div class="smart-app-custom-form">
				<form method="post" action="<?php echo get_permalink( ) ?>">
					<div class="input_name_lastName">
						<label>
							<input id="custom_form_first_name" type="text" name="custom_form_first_name" placeholder="First Name" required>
						</label>
						<label>
							<input id="custom_form_last_name" type="text" name="custom_form_last_name" placeholder="Last Name" required>
						</label>
					</div>
					<div class="input_email">
						<label>
							<input id="custom-form-email" type="email" name="custom_form_email" placeholder="email" required>
						</label>
					</div>
					<div class="input_subject">
						<label>
							<input id="custom_form_subject" type="text" name="custom_form_subject" placeholder="Subject" required>
						</label>
					</div>
					<div class="input_subject">
						<label for="custom-form-message">
							<textarea id="custom_form_message" name="custom_form_message" placeholder="Your message" rows="3"></textarea>
						</label>
					</div>
                    <button type="submit">Отправить</button>
				</form>
			</div>
		</div>
	</div><!-- .entry-content -->
    <noindex>
        <svg style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <defs>
                <symbol id="loading" viewBox="0 0 128 128">
                    <g><path d="M16 64a4 4 0 0 1-8 0C8 33.121 33.121 8 64 8c15.391 0 29.632 6.133 40 16.693V12a4 4 0 0 1 8 0v24a4 4 0 0 1-4 4H84a4 4 0 0 1 0-8h15.908C90.933 21.904 78.022 16 64 16c-26.467 0-48 21.533-48 48zm100-4a4 4 0 0 0-4 4c0 26.467-21.533 48-48 48-14.022 0-26.933-5.904-35.908-16H44a4 4 0 0 0 0-8H20a4 4 0 0 0-4 4v24a4 4 0 0 0 8 0v-12.693C34.368 113.867 48.609 120 64 120c30.879 0 56-25.121 56-56a4 4 0 0 0-4-4z" fill="#000000" data-original="#000000" class=""></path></g>
                </symbol>
            </defs>
        </svg>
    </noindex>


</article><!-- #post-<?php the_ID(); ?> -->

<?php get_footer();
