import { Button, FormFileUpload } from '@wordpress/components';
import { MediaUpload } from "@wordpress/media-utils";
const { __ } = wp.i18n;

const Uploader = ({ onChange, value, params }) => {
    const { label } = params;

    let labelContent = label ? <span className="customize-control-title kmt-control-title">{label}</span> : null;

    return <div style={{ display: 'flex', justifyContent: 'space-between' }}>
        {labelContent}
        <MediaUpload
            title={__("Select File", 'kemet')}
            onSelect={(media) => onChange(media.url)}
            value={(value && value ? value : '')}
            render={({ open }) => (
                <>
                    <div>
                        {value && <span style={{ marginRight: "5px" }}>{value}</span>}
                        <Button className="upload-button button-add-media" isDefault onClick={() => open(open)}>
                            {__("Upload", 'kemet')}
                        </Button>
                    </div>
                </>
            )}
        />
    </div>

}

export default Uploader