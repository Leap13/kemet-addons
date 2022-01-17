import { Button, FormFileUpload } from '@wordpress/components';
import { MediaUpload } from "@wordpress/media-utils";
const { __ } = wp.i18n;

const Uploader = ({ onChange, value, params }) => {
    const { label, fontType, description } = params;
    let allowed = fontType === 'svg' ? 'image/svg+xml' : `application/x-font-${fontType}`;
    let labelContent = label ? <span className="customize-control-title kmt-control-title">{label}</span> : null;

    return <div>
        {labelContent}
        <MediaUpload
            title={__("Select File", 'kemet-addons')}
            allowedTypes={[allowed]}
            onSelect={(media) => onChange(media.url)}
            value={(value && value ? value : '')}
            render={({ open }) => (
                <>
                    <div className='customize-control-content'>
                        <div>
                            <input type="text" style={{ marginRight: "5px" }} value={value} readOnly />
                            <Button className="upload-button button-add-media" isDefault onClick={() => open(open)}>
                                {__("Upload", 'kemet-addons')}
                            </Button>
                        </div>
                        {description && <p className='customize-control-description'>{description}</p>}
                    </div>
                </>
            )}
        />
    </div>

}

export default Uploader