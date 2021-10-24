import { Fragment, useState, useEffect, useContext } from "react";
import OptionsContext from "../store/options-context";
import Options from "./Options";

const Tabs = (props) => {
    const [state, setState] = useState({
        currentTab: 0,
    });

    let tabs = props.params.tabs
        ? props.params.tabs
        : {};

    const currentTab = tabs[Object.keys(tabs)[state.currentTab]];

    return (
        <Fragment>
            <ul className="tabs">
                {Object.keys(tabs).map((tab, index) => {
                    return <li
                        onClick={() => {
                            setState({ currentTab: index });
                        }
                        }
                        className={index === state.currentTab && 'active'}>
                        {tabs[tab].title}
                    </li>
                })}
            </ul>
            <div className="current-tab-options kmt-options">
                <Options options={currentTab.options} />
            </div>
        </Fragment>
    );
};

export default Tabs