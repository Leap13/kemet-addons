import { Fragment } from "@wordpress/element"
import ModalActions from "../ModalActions";
const { Dashicon } = wp.components;

const Backdrop = props => {
    return <div className="kmt-backdrop" onClick={props.onClose}></div>
}

const ModalOverlay = props => {
    return <div className={`kmt-modal ${props.classes && props.classes}`} style={props.style}>
        <div className="kmt-modal-header">
            <h2>{props.title}</h2>
            <div className="kmt-close-modal" onClick={props.onClose}>
                <Dashicon icon='no' />
            </div>
        </div>
        <div className="kmt-modal-content">{props.children}</div>
        <div className="kmt-modal-footer">
            <ModalActions />
        </div>
    </div>
}

const Modal = (props) => {
    return <Fragment>
        <Backdrop onClose={props.onClose} />
        <ModalOverlay title={props.title} classes={props.className} style={props.style} onClose={props.onClose}>{props.children}</ModalOverlay>
    </Fragment>
}

export default Modal