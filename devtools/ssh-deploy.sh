#!/usr/bin/env bash
## Usage: anson-deploy.sh host remote_dir [key]
function checkError() {
  if [[ ! $? -eq 0 ]]; then
    echo 'Shit happened'
    exit
  fi
}
login=$1
remote_dir=$2
key=$3
archive_name='comp2121-proj.tgz'
proj_dir=$PWD
proj_dir_name=` basename ${proj_dir} `

cd ../
if [[ -f ${archive_name} ]]; then rm ${archive_name}; fi
tar --exclude-vcs -czf ${archive_name} ` basename ${proj_dir} `
checkError
echo 'Done archiving. Uploading it to host...'

ssh_conn="ssh -ax"
if [[ "${key}" != "" ]]; then
  ssh_conn=${ssh_conn}" -i ${key}"
fi

lftp_conn="set sftp:connect-program '${ssh_conn}'; connect sftp://${login};"

lftp -c "${lftp_conn}""rm -rf ${archive_name}; put ${archive_name};"
checkError
echo 'Uploaded. Extracting content...'
remote_dir_bak="${remote_dir}_bak"
${ssh_conn} ${login} "set -x && if [[ -e ${remote_dir_bak} ]]; then rm -rf '${remote_dir_bak}'; fi; "\
"if [[ -e ${remote_dir} ]]; then mv '${remote_dir}' '${remote_dir_bak}'; fi; "\
"mkdir -p ${remote_dir} && tar --strip-components=1 -xf '${archive_name}' -C '${remote_dir}'"
