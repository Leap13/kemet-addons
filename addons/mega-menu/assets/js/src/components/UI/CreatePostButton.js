const { __ } = wp.i18n;

const CreatePostButton = props => {
    const titles = {
        'elemetor_library': __('Create a new Elementor Template', 'kemet-addons'),
        'wp_block': __('Create a new Reusable Block', 'kemet-addons'),
        'kemet_custom_content': __('Create a new Custom Template', 'kemet-addons'),
    }
    const link = kemetMegaMenu.edit_post_link.replace('post_name', props.type);
    return <div className="kmt-create-post">
        <a className='kmt-button secondary' href={link} target="_blank">{titles[props.type]}</a>
    </div>
}

export default CreatePostButton;