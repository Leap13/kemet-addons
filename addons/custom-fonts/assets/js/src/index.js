import { render, Fragment } from '@wordpress/element'
import MetaOptions from './components/MetaOptions';
const { __ } = wp.i18n;

const KemetPageOptions = (props) => {
    return (<MetaOptions options={props.options} id={props.id} />)
}

document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('kmt-meta-box')) {
        const { id } = document.getElementById('kmt-meta-box').dataset;
        render(<KemetPageOptions options={kemetCustomFont.options} id={id} />, document.getElementById('kmt-meta-box'))
    }
})