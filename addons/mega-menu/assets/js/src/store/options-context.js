import React from "react";

const OptionsContext = React.createContext({
    itemId: null,
    parent: null,
    isLoading: null,
    onSave: () => { },
    onClose: () => { },
    values: {},
    depth: 0,
    onChange: (value, optionId) => { },
})

export default OptionsContext