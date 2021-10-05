import Logo from "../common/logo"
const { __ } = wp.i18n;

const Header = () => {
    return <div className='kmt-panel-header'>
        <div className='logo'>
            <Logo />
        </div>
        <a href="#" className='docs kmt-button secondary' target="_blank">{__('Documentation', 'kemet')}</a>
    </div>
}

export default Header