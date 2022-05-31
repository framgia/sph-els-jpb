import { useSelector, useDispatch } from "react-redux";
import * as Reducer from "../../App/Redux/Slices/counterSlice";
import "./counter.css";

const Counter = () => {
  const { count } = useSelector((state) => state.counter);
  const dispatch = useDispatch();

  return (
    <>
      <div className="counter">
        <div className="global-state">
          <span style={{ fontWeight: 600 }}>Global State</span>
          <h1 style={{ opacity: count === 0 ? "0.6" : "1" }}>{count}</h1>
          <div className="buttons">
            <button
              disabled={count === 0 ? "disable" : ""}
              onClick={() => dispatch(Reducer.decrement())}
            >
              -
            </button>
            <button
              disabled={count < 10 ? "disable" : ""}
              onClick={() => dispatch(Reducer.decrementByAmount(10))}
            >
              - 10
            </button>
            <button onClick={() => dispatch(Reducer.incrementByAmount(10))}>
              + 10
            </button>
            <button onClick={() => dispatch(Reducer.increment())}>+</button>
          </div>
        </div>
      </div>
    </>
  );
};

export default Counter;
