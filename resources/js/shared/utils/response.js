export const is404 = (err) => {
  return isErrorWithResponseAndStatus(err) && 404 == err.response.status;
};

export const is422 = (err) => {
  return isErrorWithResponseAndStatus(err) && 422 == err.response.status;
}

const isErrorWithResponseAndStatus = (err) => {
  return err.response && err.response.status;
}
