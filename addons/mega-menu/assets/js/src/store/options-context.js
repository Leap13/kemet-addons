import React from "react";

const OptionsContext = React.createContext({
    values: {},
    depth: 0,
    onChange: (value, optionId) => { },
})

export default OptionsContext