import React from "react";

const OptionsContext = React.createContext({
    values: {},
    onChange: (value, optionId) => { },
})

export default OptionsContext