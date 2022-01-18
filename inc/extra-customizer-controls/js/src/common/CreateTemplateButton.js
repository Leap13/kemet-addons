const { Button } = wp.components;
const { __ } = wp.i18n;

const CreateTemplateButton = props => {
    console.log(props);
    const titles = {
        'elementor_library': __('Create a new Elementor Template', 'kemet-addons'),
        'wp_block': __('Create a new Reusable Block', 'kemet-addons'),
    }
    const link = kemetAddonsExtraCustomizerControls.edit_post_link.replace('post_name', props.type);

    return <div className="kmt-create-post">
        <Button isSecondary={true} href={link} target="_blank">{titles[props.type]}</Button>
    </div>
}


export default CreateTemplateButton;