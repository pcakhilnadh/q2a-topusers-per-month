<?php
class qa_tupm_admin {

	function allow_template($template)
	{
		return ($template!='admin');
	}

	function option_default($option) {

		switch($option) {
			case 'tupm-plugin-css':
				return '
.topusers ol{ list-style:none; margin-left: -15px;}
.topusers .qa-widget-side a {
                                        display:initial;}
.topusers img{
float:left;
}
.topusers-span {
    display: inline-block;
    margin-left: 10px;
}
.topusers .uscore{
font-family: Impact;
}
.tupm-title {
    font-family: Arial;
    font-size: large;
    font-weight: bold;
margin-top: 10px;
}
.topusers-page{
font-size: large;
}
.topusers-page .tupm-title {
margin-bottom: 10px;
}

				';
			case 'qa-tupm-plugin-title':
				return 'Top Monthly Users';
			case 'qa-tupm-widget-count':
				return '10';
			case 'qa-tupm-page-count':
				return '20';
			case 'qa-tupm-admin-hide':
				return '';
			case 'qa-tupm-reward-enable':
				return '';
			case 'qa-tupm-reward-html':
				return '200 points';
			default:
				return null;

		}
	}
	function admin_form(&$qa_content)
	{

		//	Process form input

		$ok = null;
		if (qa_clicked('tupm-save-button')) {
			foreach($_POST as $i => $v) {

				qa_opt($i,$v);
			}

			$ok = qa_lang('admin/options_saved');
		}
		else if (qa_clicked('tupm-reset-button')) {
			foreach($_POST as $i => $v) {
				$def = $this->option_default($i);
				if($def !== null) qa_opt($i,$def);
			}
			$ok = qa_lang('admin/options_reset');
		}			
		//	Create the form for display


		$fields = array();


		$fields[] = array(
				'label' => 'Top Users per Month custom css',
				'tags' => 'NAME="tupm-plugin-css"',
				'value' => qa_opt('tupm-plugin-css'),
				'type' => 'textarea',
				'rows' => 20
				);
		$fields[] = array(
				'label' => 'Top Users per Month Title',
				'tags' => 'NAME="qa-tupm-plugin-title"',
				'value' => qa_opt('qa-tupm-plugin-title'),
				'type' => 'text',
				);
		$fields[] = array(
				'label' => 'Top Users Count in Widget',
				'tags' => 'NAME="qa-tupm-widget-count"',
				'value' => qa_opt('qa-tupm-widget-count'),
				'type' => 'number',
				);
		$fields[] = array(
				'label' => 'Top Users Count in Page',
				'tags' => 'NAME="qa-tupm-page-count"',
				'value' => qa_opt('qa-tupm-page-count'),
				'type' => 'number',
				);
		$fields[] = array(
				'label' => 'Enable Rewards',
				'tags' => 'NAME="qa-tupm-reward-enable"',
				'value' => qa_opt('qa-tupm-reward-enable'),
				'type' => 'checkbox',
				);
		$fields[] = array(
				'label' => 'Reward HTML',
				'tags' => 'NAME="qa-tupm-reward-html"',
				'value' => qa_opt('qa-tupm-reward-html'),
				'type' => 'textarea',
				'rows' => 20,
				);
		$fields[] = array(
				'label' => 'Hide admins from Top Users List',
				'tags' => 'NAME="qa-tupm-hide-admin"',
				'value' => qa_opt('qa-tupm-hide-admin'),
				'type' => 'checkbox',
				);


		return array(
				'ok' => ($ok && !isset($error)) ? $ok : null,

				'fields' => $fields,

				'buttons' => array(
					array(
						'label' => qa_lang_html('main/save_button'),
						'tags' => 'NAME="tupm-save-button"',
					     ),
					array(
						'label' => qa_lang_html('admin/reset_options_button'),
						'tags' => 'NAME="tupm-reset-button"',
					     ),
					),
			    );
	}


}