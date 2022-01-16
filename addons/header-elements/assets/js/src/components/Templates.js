import { useState } from 'react';
import CreateTemplateButton from "../common/CreateTemplateButton";
import SelectTemplate from '../common/SelectTemplate';
const { __ } = wp.i18n;

const Templates = ({ onChange, params, value: optionValue }) => {
    const { label, template } = params;
    const [value, setValue] = useState(optionValue);

    const HandleChange = (newValue) => {
        setValue(newValue);
        onChange(newValue);
    }
    let posts = kemetHeaderElements.posts[template];
    if (kemetHeaderElements.posts_count[template]) {
        const postsArr = Object.entries(posts);
        const filteredArr = postsArr.filter(function ([key, value]) {
            return value !== 'Default Kit';
        });
        posts = Object.fromEntries(filteredArr);
    }

    return <>
        <span className="customize-control-title kmt-control-title">{label}</span>
        <div className="customize-control-content">
            {Object.keys(posts).length ? <SelectTemplate value={value} onChange={HandleChange} posts={posts} /> : <CreateTemplateButton type={template} />}

        </div>
    </>
}

export default Templates