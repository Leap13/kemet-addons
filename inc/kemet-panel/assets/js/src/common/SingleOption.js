const SingleOption = (props) => {
    return <div className='option-card'>
        <div className="icon"></div>
        {props.children}
    </div>
}

export default SingleOption