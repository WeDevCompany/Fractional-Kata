let PasswordValidator = require('../src/change-my-name');

describe('Kata use case', () => {
  it('change_this_name', () => {
    let changeMyName = new ChangeMyName();

    expect(changeMyName.changeThisName()).toBe(true);
  });
});
